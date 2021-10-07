# dialogflow-php
- PHP Client Library for Dialogflow API v2

## Requirements

* [Dialogflow Agent](https://dialogflow.com/docs/reference/v2-agent-setup)
* [Google Account Credentials file](https://cloud.google.com/docs/authentication/production)
* [PHP ](http://php.net/downloads.php)
* [Composer](https://getcomposer.org/)

## Installation

- To begin, lets clone this repository
```bash
git clone https://github.com/sumithemmadi/dialogflow-php.git
cd dialogflow-php
```
- Then  install the preferred dependencies for Dialogflow.

```bash
composer install
```

- Or install latest version with below command:
```bash
composer require google/cloud-dialogflow
```
<details>
<h2 id="before" data-text="Before you begin">Before you begin</h2>
<p>You should do the following before reading this guide:</p>
<ol>
  <li>Read <a href="/dialogflow/docs/basics">Dialogflow basics</a>. </li>
  <li>Read <a href="/dialogflow/docs/editions">Editions</a>. </li>
</ol>
<h2 id="gcp-console" data-text="About the Google Cloud Console">About the Google Cloud Console</h2>
<p>
<p> The Google Cloud Console ( <a href="https://support.google.com/cloud/answer/3465889?hl=en&ref_topic=3340599" class="external" target="_blank">visit documentation</a>, <a href="https://console.cloud.google.com/" class="external" target="_blank">open console</a>) is a web UI used to provision, configure, manage, and monitor systems that use Google Cloud products. You use the Google Cloud Console to set up and manage Dialogflow resources. </p>
</p>
<h2 id="project" data-text="Create a project">Create a project</h2>
<p>
<p> To use services provided by Google Cloud, you must create a <em>project</em>. A project organizes all your Google Cloud resources. A project consists of a set of collaborators, enabled APIs (and other resources), monitoring tools, billing information, and authentication and access controls. You can create one project, or you can create multiple projects and use them to organize your Google Cloud resources in a <a href="/resource-manager/docs/cloud-platform-resource-hierarchy">resource hierarchy</a>. When creating a project, take note of the <a href="/resource-manager/docs/creating-managing-projects#identifying_projects">project ID</a>. You will need this ID to make API calls. For more information on projects, see the <a href="/resource-manager/docs/creating-managing-projects">Resource Manager documentation</a>. </p>
</p>
<p>The Dialogflow ES Console ( <a href="/dialogflow/docs/console">visit documentation</a>, <a href="https://dialogflow.cloud.google.com" class="external" target="_blank">open console</a>) can optionally create a basic project for you when you create an agent. If you plan on using your project for more than just basic access to a <a href="/dialogflow/docs/editions">free edition</a>, or you plan on using the API, you should create a project with the Google Cloud Console as described below. </p>
<p>We recommend that you create separate projects for experiments, testing, and production. Each project can only create one <a href="/dialogflow/docs/agents-overview">Dialogflow Agent</a>. If you need multiple agents, you will need to create multiple projects. </p>
<p>
<p>In the Google Cloud Console, on the project selector page, select or create a Google Cloud project.</p>
<p>
  <a href="https://console.cloud.google.com/projectselector2/home/dashboard" target="console" track-type="commonIncludes" track-name="consoleLink" track-metadata-end-goal="createProject" class="button button-primary">Go to project selector</a>
</p>
</p>
<aside class="warning">
  <strong>Warning:</strong>
  <span> If a project is deleted, the agents linked to the project cannot be recovered.</span>
</aside>
<h2 id="billing" data-text="Enable billing">Enable billing</h2>
<aside class="note">
  <strong>Note:</strong>
  <span> You can skip this step if you are only using a free <a href="/dialogflow/docs/editions">Dialogflow edition</a>. </span>
</aside>
<p>
<p> A billing account is used to define who pays for a given set of resources, and it can be linked to one or more projects. Project usage is charged to the linked billing account. In most cases, you configure billing when you create a project. For more information, see the <a href="/billing/docs">Billing documentation</a>. </p>
<p> Make sure that billing is enabled for your Cloud project. <a href="/billing/docs/how-to/modify-project#confirm_billing_is_enabled_on_a_project" target="_blank" track-type="commonIncludes" track-name="supportLink" track-metadata-end-goal="enableBilling">Learn how to confirm that billing is enabled for your project</a>. </p>
</p>
<h2 id="api" data-text="Enable the API">Enable the API</h2>
<aside class="note">
  <strong>Note:</strong>
  <span> You can skip this step if you are using the Dialogflow Console to create your project.</span>
</aside>
<p>
<p> You must enable the Dialogflow API for your project. For more information on enabling APIs, see the <a href="/service-usage/docs/enable-disable">Service Usage documentation</a>. 
<img src="https://user-images.githubusercontent.com/50250422/135780264-48c383ce-7942-418f-baf8-703b5257fd30.png"></img>
</p> Enable the Dialogflow API. <p>
  <a href="https://console.cloud.google.com/flows/enableapi?apiid=dialogflow.googleapis.com" target="console" track-type="commonIncludes" track-name="consoleLink" track-metadata-end-goal="enableAPI" class="button button-primary">Enable the API</a>
</p>

</p>
<h2 id="audit-logs" data-text="Enable audit logs">Enable audit logs</h2>
<aside class="note">
  <strong>Note:</strong>
  <span> You can skip this step for non-production agents.</span>
</aside>
<p>Enable Data Access <a href="/dialogflow/es/docs/reference/audit-logging">audit logs</a> for Dialogflow API in your project. This can help you track design-time changes in the Dialogflow agents linked to this project. </p>
<h2 id="auth" data-text="Set up authentication">Set up authentication</h2>
<aside class="note">
  <strong>Note:</strong>
  <span> You can skip this step if you will not be using the API.</span>
</aside>
<p>
<p> If you plan to use the Dialogflow API, you need to set up authentication. Any client application that uses the API must be authenticated and granted access to the requested resources. This section describes important authentication concepts and provides steps for setting it up. For more information, see the <a href="/docs/authentication">Google Cloud authentication overview</a>. </p>
</p>
<h3 id="sa" data-text="About service accounts">About service accounts</h3>
<p>
<p> There are multiple options for authentication, but it is recommended that you use <em>service accounts</em> for authentication and access control. A service account provides credentials for applications, as opposed to end-users. Service accounts are owned by projects, and you can create many service accounts for a project. For more information, see <a href="/iam/docs/understanding-service-accounts">Understanding service accounts</a>. </p>
</p>
<h3 id="role" data-text="About roles">About roles</h3>
<p>
<p> When an identity calls an API, Google Cloud requires that the identity has the appropriate permissions. You can grant permissions by granting <em>roles</em> to a service account. For more information, see the <a href="/iam/docs/understanding-roles">Identity and Access Management (IAM) documentation</a>. </p>
</p>
<p>For the purpose of trying the Dialogflow API, you can use the <strong>Project &gt; Owner</strong> role in steps below, which grants the service account full access to the project. For more information on roles specific to Dialogflow, see the <a href="/dialogflow/docs/access-control">Dialogflow access control document</a>. </p>
<h3 id="keys" data-text="About service account keys">About service account keys</h3>
<p>
<p> Service accounts are associated with one or more public/private key pairs. When you create a new key pair, you download the private key. Your private key is used to generate credentials when calling the API. You are responsible for security of the private key and other management operations, such as key rotation. </p>
</p>
<h3 id="sa-create" data-text="Create a service account and download the private key file">Create a service account and download the private key file</h3>
<p>
<img src="https://user-images.githubusercontent.com/50250422/135780322-ed003c6f-cf2e-47dd-9c0f-e176e90fc91c.png"></img>
<p> Create a service account: </p>
<ol>
  <li>
    <p> In the Cloud Console, go to the <b>Create service account</b> page. </p>
    <a href="https://console.cloud.google.com/projectselector/iam-admin/serviceaccounts/create?supportedpurview=project" class="button button-primary" target="console" track-name="consoleLink" track-type="quickstart" track-metadata-position="body">Go to Create service account</a>
  </li>
  <li> Select a project. </li>
  <li>
    <p> In the <b>Service account name</b> field, enter a name. The Cloud Console fills in the <b>Service account ID</b> field based on this name. </p>
    <p> In the <b>Service account description</b> field, enter a description. For example, <code translate="no" dir="ltr">Service account for quickstart</code>. </p>
  </li>
  <li> Click <b>Create and continue</b>. </li>
  <li>
    <p> Click the <b>Select a role</b> field. </p>
    <p> Under <b>Quick access</b>, click <b>Basic</b>, then click <b>Owner</b>. </p>
    <aside class="note">
      <b>Note</b>: The <b>Role</b> field affects which resources your service account can access in your project. You can revoke these roles or grant additional roles later. In production environments, do not grant the Owner, Editor, or Viewer roles. Instead, grant a <a href="/iam/docs/understanding-roles#predefined_roles">predefined role</a> or <a href="/iam/docs/understanding-custom-roles">custom role</a> that meets your needs.
    </aside>
  </li>
  <li> Click <b>Continue</b>. </li>
  <li>
    <p> Click <b>Done</b> to finish creating the service account. </p>
    <p> Do not close your browser window. You will use it in the next step. </p>
  </li>
</ol>
<p> Create a service account key: </p>
<ol>
  <li> In the Cloud Console, click the email address for the service account that you created. </li>
  <li> Click <b>Keys</b>. </li>
  <li> Click <b>Add key</b>, then click <b>Create new key</b>. </li>
  <li> Click <b>Create</b>. A JSON key file is downloaded to your computer. </li>
  <img src="https://user-images.githubusercontent.com/50250422/135780443-9d351d03-405c-49a4-9317-9131bab92041.png"></img>
  <li> Click <b>Close</b>. </li>
</ol>
</p>
</details>

## Usage
- Download the Google Account Credentials JSON file for your v2 Dialogflow agent into the diaglogflow-php folder

- Make sure v2 API is enabled in Dialogflow
![client_secret_json_download_1](https://user-images.githubusercontent.com/50250422/135780264-48c383ce-7942-418f-baf8-703b5257fd30.png)
- Click on the service account email address.
- You will be taken to the Google Cloud Console.
- Click on the Create Service Account link at the top of the console menu
- Provide a suitable name for the service account
- Select Project -> Owner in the Role dropdown box
- Make sure you check the Furnish a new private key box. Keep the key type as JSON
![client_secret_json_download_2](https://user-images.githubusercontent.com/50250422/135780322-ed003c6f-cf2e-47dd-9c0f-e176e90fc91c.png)
- Click on the create
![create_key_slideout](https://user-images.githubusercontent.com/50250422/135780443-9d351d03-405c-49a4-9317-9131bab92041.png)
- You will be prompted to save the Google Account Credentials JSON file. Save the file as `service-account-file.json` to the dialogflow-php folder.
> Make sure that `service-account-file.json` file is in  main directory
- Now create a web server and send a post request.
```sh
curl -Xs POST http://localhost:8080/dialogflow.php \
-d '{"sender":"sumith","message":"my name is sumith"}'
```
```sh
~$ curl -sX POST http://localhost:8080/dialogflow.php \
-d '{"sender":"sumith","message":"my name is sumith"}'

{
    "responseId": "f7f810a1-0043-4f85-ac6c-241705aa6b8a-94f60986",
    "queryResult": {
        "queryText": "my name is sumith",
        "languageCode": "en",
        "parameters": {
            "person": {
                "name": "sumith"
            }
        },
        "allRequiredParamsPresent": true,
        "fulfillmentText": "Sorry, I was not able to understand your intention . I'm trying to get better at this thing.",
        "fulfillmentMessages": [
            {
                "text": {
                    "text": [
                        "Sorry, I was not able to understand your intention . I'm trying to get better at this thing."
                    ]
                }
            }
        ],
        "intent": {
            "name": "projects\/sumith-rwup\/agent\/intents\/f95d3add-52fb-4119-87f0-e1717181173d",
            "displayName": "user.name"
        },
        "intentDetectionConfidence": 1
    }
}
```

## Testing
- After saving the `service-account-file.json` file in main directory.
- start a PHP server (for testing purpose)
```php
php -S localhost:8080
```
- Now open http://localhost:8080 in any web browser.

- Now enter any name in `sender` field and enter any message in `message` field.
- Click send message you will see `fullfilment message` 
> Note: Wait untill you get fulfilment message.

## LICENSE
   Apache License
   Version 2.0, January 2004
   http://www.apache.org/licenses/

   Copyright  2021  <b>sumithemmadi</b>

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.

