import requests
from bs4 import BeautifulSoup

# The URL of your website
BASE_URL = "https://betheledison.com"

def audit_aura_site(url):
    print(f"--- Starting AURA SEO Audit for: {url} ---\n")
    try:
        response = requests.get(url, timeout=10)
        if response.status_code != 200:
            print(f"❌ Alert: Main site returned status {response.status_code}")
            return

        soup = BeautifulSoup(response.text, 'html.parser')

        # 1. Check Metadata
        title = soup.find('title')
        description = soup.find('meta', attrs={'name': 'description'})

        print(f"✅ Title: {title.text if title else 'MISSING'}")
        print(f"✅ Description: {description['content'] if description else 'MISSING'}\n")

        # 2. Check for Broken Links (404s)
        print("--- Checking Internal Links ---")
        links = soup.find_all('a', href=True)
        for link in links:
            href = link['href']
            # Only check internal links to save time
            if href.startswith('/') or BASE_URL in href:
                full_url = href if href.startswith('http') else f"{BASE_URL}{href}"
                try:
                    res = requests.head(full_url, timeout=5)
                    status = res.status_code
                    if status == 404:
                        print(f"❌ BROKEN: {full_url}")
                    else:
                        print(f"✔ OK ({status}): {full_url}")
                except:
                    print(f"⚠️ Could not reach: {full_url}")

    except Exception as e:
        print(f"An error occurred: {e}")

if __name__ == "__main__":
    audit_aura_site(BASE_URL)