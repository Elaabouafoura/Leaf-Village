import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
import joblib
import random
from faker import Faker

fake = Faker()

data = []

# Générer 100 projets verts synthétiques
for _ in range(100):
    budget = random.randint(5000, 500000)
    duration = random.randint(3, 36)
    partners = random.randint(1, 10)
    description = fake.sentence(nb_words=12) + " projet vert durable"
    funded = random.choices([0,1], weights=[0.4,0.6])[0]
    data.append([budget, duration, partners, description, funded])

df = pd.DataFrame(data, columns=["budget","duration","partners","description","funded"])

# Features numériques
X = df[["budget","duration","partners"]]
y = df["funded"]

# Split train/test
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Entraîner le modèle
model = RandomForestClassifier(n_estimators=100, random_state=42)
model.fit(X_train, y_train)

# Sauvegarder le modèle
joblib.dump(model, "funding_model_verts.joblib")

print("✅ Modèle ML entraîné pour projets verts !")
