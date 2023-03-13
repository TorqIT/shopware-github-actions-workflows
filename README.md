This repository contains several [reusable GitHub Actions workflows](https://docs.github.com/en/actions/using-workflows/reusing-workflows) that can be referenced when developing Pimcore projects. 

### Usage
The aforementioned link should provide the necessary information for using these workflows within your project, but generally you can call a workflow like this:
```yaml
  jobs:
    call-reusable-workflow:
      uses: TorqIT/pimcore-github-actions-workflows/.github/workflows/workflow-file.yml@sha
      # If the reusable workflow requires inputs:
      with:
        input1: value
        input2: value
      # If the reusable workflow requires secrets:
      secrets:
        secret1: value
        secret2: value
```
where `workflow-file.yml` refers to the actual workflow file you wish to use, and `sha` refers to a commit SHA, tag (e.g. `v1`) or branch name (e.g. `main`). This repository uses a semantic versioning scheme, so referring to a major tag (e.g. `v1`) will allow you to automatically get fixes/non-breaking improvements.

### Environment variables
At present, reusable workflows can access environment variables (i.e. the `vars` context), and therefore do not need these values to be passed as inputs. However, they cannot yet access environment secrets, so these need to be passed by the caller as demonstrated above.

### Self-hosted runners
All workflows contain an optional `RUNNER` input that will accept the name of a self-hosted runner. If this parameter is not provided, an `ubuntu-latest` GitHub runner will be used.

Per [GitHub's documentation](https://docs.github.com/en/actions/using-workflows/reusing-workflows#using-self-hosted-runners), these workflows can only access self-hosted runners in the [Torq IT organization](https://github.com/torqit). As a workaround, you can fork this repository into your organization in order to utilize your organization's self-hosted runners.

### Tokens
The [default token used by GitHub Actions](https://docs.github.com/en/actions/security-guides/automatic-token-authentication#permissions-for-the-github_token) has fairly limited permissions. For some operations, such as [triggering another workflow when pushing to a branch](https://github.com/TorqIT/pimcore-github-actions-workflows/blob/main/.github/workflows/reset-dev-to-main.yml), this token's permissions will not be sufficient. As a workaround, [create](https://docs.github.com/en/apps/creating-github-apps/creating-github-apps/creating-a-github-app) and [install](https://docs.github.com/en/apps/maintaining-github-apps/installing-github-apps) a GitHub App in your repository or organization, and [generate a private key](https://docs.github.com/en/apps/creating-github-apps/authenticating-with-a-github-app/managing-private-keys-for-github-apps#generating-private-keys). Most of the workflows in this repository then depend on the following two secrets to be present in your organization or repository:
1. `WORKFLOW_APP_ID`, with the value being the "App ID" field from your GitHub App's "App settings" page.
2. `WORKFLOW_PRIVATE_KEY`, with the value being the contents of the private key generated above.

Each workflow requiring these secrets will detail the required permissions for your GitHub App.
