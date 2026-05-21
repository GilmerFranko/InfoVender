
git diff --name-only HEAD~1..HEAD | tr '\n' '\0' | xargs -0 git archive -o cambios_kingsbeet.tar.gz HEAD --
