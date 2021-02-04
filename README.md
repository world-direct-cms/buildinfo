# buildinfo

This extension adds information from certain files in the application root directory to the TYPO3 backend.

Currently 3 files are supported
- buildNumer:       The build number from azure devops server
- buildTimestamp:   The timestamp of the last build
- gitVersion:       The git version (tag) of the according composer project repository

You can configure the names of the files in the constants. The default values are:
- buildNumber.txt
- buildTimestamp.txt
- gitVersion.txt

These files should be created by the "build" step on a CI/CD server (Azure DevOps server, for example).
