from fastapi import FastAPI
from pydantic import BaseModel
import joblib
import numpy as np

model = joblib.load("funding_model_verts.joblib")

app = FastAPI()

class ProjectData(BaseModel):
    budget: float
    duration: int
    partners: int
    description: str

@app.post("/analyze")
def analyze_project(data: ProjectData):
    features = np.array([[data.budget, data.duration, data.partners]])
    proba = model.predict_proba(features)[0][1]
    score = round(proba*100,2)

    if score > 75:
        recommendation = "High potential "
    elif score > 50:
        recommendation = "Medium potential"
    else:
        recommendation = "High risk"

    return {
        "score": score,
        "recommendation": recommendation,
        "comment": f"Estimated probability of funding {score}% for a green project."
    }
