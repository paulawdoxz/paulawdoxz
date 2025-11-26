import requests
import json

# Basis URL en zoekparameters
basis_url = "https://stagemarkt.nl/api/query-hub/education-search"
params = {
    "siteId": "STAGEMARKT",
    "pageSize": 12,
    "niveau": 4,
    "type": 1,
    "range": 25,
    "crebocode": "25998",
    "plaatsPostcode": "Uithoorn",
    "learningPath": "2468c1a0-ad7b-4209-b27b-b12ae0e3d1d2",
    "buitenlandseBedrijven": "false",
    "pageNumber": 1
}

headers = {"User-Agent": "Mozilla/5.0"}

# Lijst voor alle stages
alle_stages = []

# Ophalen van alle pagina's
while True:
    print(f"Pagina {params['pageNumber']} ophalen...")
    resp = requests.get(basis_url, params=params, headers=headers)
    data = resp.json()
    
    items = data.get("items", [])
    
    for stage in items:
        organisatie = stage.get("organisatie", {})
        adres = stage.get("adres", {})
        url = f"https://stagemarkt.nl/stage/{stage.get('leerplaatsId', '')}"
        
        alle_stages.append({
            "titel": stage.get("titel", ""),
            "wervendeTitel": stage.get("wervendeTitel", ""),
            "bedrijf": organisatie.get("naam", ""),
            "straat": adres.get("straat", ""),
            "huisnummer": adres.get("huisnummer", ""),
            "postcode": adres.get("postcode", ""),
            "plaats": adres.get("plaats", ""),
            "url": url,
            "startdatum": stage.get("startdatum", ""),
            "niveau": stage.get("kwalificatie", {}).get("niveaunaam", ""),
            "leerweg": stage.get("leerweg", "")
        })
    
    if params["pageNumber"] >= data.get("totalPages", 1):
        break
    params["pageNumber"] += 1

print(f"Gevonden: {len(alle_stages)} stages.")

# Opslaan naar JSON 
with open("vacatures.json", "w", encoding="utf-8") as f:
    json.dump(alle_stages, f, ensure_ascii=False, indent=2)

print("Klaar! Gegevens opgeslagen in 'vacatures.json'.")
