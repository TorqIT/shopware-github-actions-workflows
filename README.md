This repository contains several [reusable GitHub Actions workflows](https://docs.github.com/en/actions/using-workflows/reusing-workflows) that can be referenced when developing Pimcore projects. The aforementioned link should provide the necessary information for using these workflows within your project, but generally you can call a workflow like this:
```yaml
  jobs:
    call-reusable-workflow:
      uses: TorqIT/pimcore-github-actions-workflows/.github/workflows/workflow-file.yaml@tag
      # If the reusable workflow requires inputs:
      with:
        input1: value
        input2: value
      # If the reusable workflow requires secrets:
      secrets:
        secret1: value
        secret2: value
```
Where `workflow-file.yml` refers to the actual workflow file you wish to use, and `tag` refers to a SHA, release tag or branch name (e.g. `main`). This repository uses a semantic versioning scheme, so referring to a major tag (e.g. `v1`) will allow you to automatically get fixes/non-breaking improvements.

Note that, at present, reusable workflows can access environment variables (i.e. the `vars` context), and therefore do not need these values to be passed as inputs. However, they cannot yet access environment secrets, so these need to be passed by the caller as demonstrated above.
