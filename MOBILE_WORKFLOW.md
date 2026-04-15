# AURA Mobile-First Development Workflow
**Version:** 1.0  
**Hardware:** Samsung Galaxy A06  
**Core Stack:** Acode, Termux, GitHub Actions, Python 3.10

---

## 1. Local Environment Setup
To build professional software from a mobile device, utilize the following local environment configuration:

* **Acode (IDE):** Primary editor for HTML, CSS, JavaScript, and Python scripts. 
* **Termux (Terminal):** Used for local script execution and testing. 
    * *Command to link storage:* `termux-setup-storage`
    * *Python Installation:* `pkg install python && pip install requests beautifulsoup4`
* **GitHub App:** Used for issue tracking, repository management, and monitoring deployments.

---

## 2. Development & Testing Pipeline
Before deploying code to a live repository, follow these verification steps:

1.  **Code Creation:** Write logic in **Acode**. Save files in organized project folders (e.g., `/AURA TERMINAL V2.6/`).
2.  **Pathing Protocol:** When referencing folders with spaces in a terminal or script, always wrap the path in double quotes: `"Folder Name/file.py"`.
3.  **Local Execution:** Test scripts in **Termux** to ensure no `ModuleNotFound` or logic errors exist before pushing to the cloud.

---

## 3. Automation via GitHub Actions
Transition manual tasks to cloud-based automation using the `.github/workflows/` directory.

### Configuration Standard (`seo-audit.yml`):
* **Trigger:** Set to `schedule` using Cron (e.g., `0 0 * * 0` for Sunday Midnight) or `workflow_dispatch` for manual control.
* **Environment:** Use `ubuntu-latest` with `actions/setup-python@v4`.
* **Execution:** Point the `run` command to the exact repository path.
    * *Example:* `python "AURA TERMINAL V2.6/seo_auditor.py"`

---

## 4. Operational Maintenance
* **Issue Tracking:** Every major task (Audit, UI Tweak, New Feature) must have a corresponding **GitHub Issue**.
* **Validation:** Automation is verified once the GitHub Actions tab returns a **Green Checkmark**.
* **Deployment:** Public-facing code (website) lives in public repos; financial/strategic data lives in the **Private Vault**.

---

> **AURA Philosophy:** Efficiency is not about the size of the screen, but the logic of the architecture.

---
