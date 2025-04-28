<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>


    <script src="{{ asset("/vendor/scribe/js/theme-default-5.1.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTstats">
                                <a href="#endpoints-POSTstats">Récupérer les statistiques filtrées.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETstats">
                                <a href="#endpoints-GETstats">Lire toutes les statistiques.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETstats--id-">
                                <a href="#endpoints-GETstats--id-">Lire une statistique spécifique.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTstats--id-">
                                <a href="#endpoints-PUTstats--id-">Mettre à jour une statistique.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEstats--id-">
                                <a href="#endpoints-DELETEstats--id-">Supprimer une statistique.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTstats-create">
                                <a href="#endpoints-POSTstats-create">Créer une statistique.</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: April 10, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTstats">Récupérer les statistiques filtrées.</h2>

<p>
</p>

<p>Cette méthode permet de récupérer les statistiques en fonction des filtres fournis, tels que le pays, le type de pandémie, et les dates de début et de fin.</p>

<span id="example-requests-POSTstats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/stats?startDate=2020-03-02&amp;endDate=2020-03-10&amp;countryId=63&amp;typeId=1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/stats"
);

const params = {
    "startDate": "2020-03-02",
    "endDate": "2020-03-10",
    "countryId": "63",
    "typeId": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTstats">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;nouveaux_cas&quot;: 100,
        &quot;nouveaux_deces&quot;: 5,
        &quot;nouveaux_gueris&quot;: 50,
        &quot;cas_actifs&quot;: 200,
        &quot;id_pays&quot;: 63,
        &quot;nom_pandemie&quot;: &quot;COVID-19&quot;,
        &quot;id_pandemie&quot;: 1,
        &quot;nom_pays&quot;: &quot;France&quot;,
        &quot;date&quot;: &quot;2020-03-02&quot;
    },
    {
        &quot;nouveaux_cas&quot;: 150,
        &quot;nouveaux_deces&quot;: 10,
        &quot;nouveaux_gueris&quot;: 120,
        &quot;cas_actifs&quot;: 300,
        &quot;id_pays&quot;: 63,
        &quot;nom_pandemie&quot;: &quot;COVID-19&quot;,
        &quot;id_pandemie&quot;: 1,
        &quot;nom_pays&quot;: &quot;France&quot;,
        &quot;date&quot;: &quot;2020-03-03&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-POSTstats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTstats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTstats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTstats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTstats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTstats" data-method="POST"
      data-path="stats"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTstats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTstats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTstats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>startDate</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="startDate"                data-endpoint="POSTstats"
               value="2020-03-02"
               data-component="query">
    <br>
<p>date La date de début pour filtrer les statistiques. Example: <code>2020-03-02</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>endDate</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="endDate"                data-endpoint="POSTstats"
               value="2020-03-10"
               data-component="query">
    <br>
<p>date La date de fin pour filtrer les statistiques. Example: <code>2020-03-10</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>countryId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="countryId"                data-endpoint="POSTstats"
               value="63"
               data-component="query">
    <br>
<p>L'ID du pays pour filtrer les statistiques. Example: <code>63</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>typeId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="typeId"                data-endpoint="POSTstats"
               value="1"
               data-component="query">
    <br>
<p>L'ID du type de pandémie pour filtrer les statistiques. Example: <code>1</code></p>
            </div>
                </form>

                    <h2 id="endpoints-GETstats">Lire toutes les statistiques.</h2>

<p>
</p>

<p>Récupère toutes les statistiques disponibles dans la base de données.</p>

<span id="example-requests-GETstats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/stats" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/stats"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETstats">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id_stat&quot;: 1,
        &quot;nouveaux_cas&quot;: 100,
        &quot;nouveaux_deces&quot;: 5,
        &quot;nouveaux_gueris&quot;: 50,
        &quot;cas_actifs&quot;: 200,
        &quot;id_pays&quot;: 1,
        &quot;id_pandemie&quot;: 1,
        &quot;date&quot;: &quot;2023-04-09&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETstats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETstats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETstats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETstats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETstats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETstats" data-method="GET"
      data-path="stats"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETstats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETstats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETstats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETstats--id-">Lire une statistique spécifique.</h2>

<p>
</p>

<p>Récupère une statistique par son ID.</p>

<span id="example-requests-GETstats--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/stats/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/stats/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETstats--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id_stat&quot;: 1,
    &quot;nouveaux_cas&quot;: 100,
    &quot;nouveaux_deces&quot;: 5,
    &quot;nouveaux_gueris&quot;: 50,
    &quot;cas_actifs&quot;: 200,
    &quot;id_pays&quot;: 1,
    &quot;id_pandemie&quot;: 1,
    &quot;date&quot;: &quot;2023-04-09&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Stat not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETstats--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETstats--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETstats--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETstats--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETstats--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETstats--id-" data-method="GET"
      data-path="stats/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETstats--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>stats/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETstats--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETstats--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETstats--id-"
               value="1"
               data-component="url">
    <br>
<p>L'ID de la statistique. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTstats--id-">Mettre à jour une statistique.</h2>

<p>
</p>

<p>Met à jour les informations d'une statistique existante.</p>

<span id="example-requests-PUTstats--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/stats/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"nouveaux_cas\": 150,
    \"nouveaux_deces\": 10,
    \"nouveaux_gueris\": 120,
    \"cas_actifs\": 300
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/stats/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "nouveaux_cas": 150,
    "nouveaux_deces": 10,
    "nouveaux_gueris": 120,
    "cas_actifs": 300
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTstats--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id_stat&quot;: 1,
    &quot;nouveaux_cas&quot;: 150,
    &quot;nouveaux_deces&quot;: 10,
    &quot;nouveaux_gueris&quot;: 120,
    &quot;cas_actifs&quot;: 300,
    &quot;id_pays&quot;: 1,
    &quot;id_pandemie&quot;: 1,
    &quot;date&quot;: &quot;2023-04-09&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Stat not found or update failed&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTstats--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTstats--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTstats--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTstats--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTstats--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTstats--id-" data-method="PUT"
      data-path="stats/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTstats--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>stats/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTstats--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTstats--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTstats--id-"
               value="1"
               data-component="url">
    <br>
<p>L'ID de la statistique. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nouveaux_cas</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="nouveaux_cas"                data-endpoint="PUTstats--id-"
               value="150"
               data-component="body">
    <br>
<p>Le nombre de nouveaux cas. Example: <code>150</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nouveaux_deces</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="nouveaux_deces"                data-endpoint="PUTstats--id-"
               value="10"
               data-component="body">
    <br>
<p>Le nombre de nouveaux décès. Example: <code>10</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nouveaux_gueris</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="nouveaux_gueris"                data-endpoint="PUTstats--id-"
               value="120"
               data-component="body">
    <br>
<p>Le nombre de nouveaux guéris. Example: <code>120</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cas_actifs</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cas_actifs"                data-endpoint="PUTstats--id-"
               value="300"
               data-component="body">
    <br>
<p>Le nombre de cas actifs. Example: <code>300</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEstats--id-">Supprimer une statistique.</h2>

<p>
</p>

<p>Supprime une statistique par son ID.</p>

<span id="example-requests-DELETEstats--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/stats/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/stats/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEstats--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Stat deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Stat not found or delete failed&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEstats--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEstats--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEstats--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEstats--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEstats--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEstats--id-" data-method="DELETE"
      data-path="stats/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEstats--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>stats/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEstats--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEstats--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEstats--id-"
               value="1"
               data-component="url">
    <br>
<p>L'ID de la statistique. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTstats-create">Créer une statistique.</h2>

<p>
</p>

<p>Ajoute une nouvelle statistique dans la base de données.</p>

<span id="example-requests-POSTstats-create">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/stats/create" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"nouveaux_cas\": 100,
    \"nouveaux_deces\": 5,
    \"nouveaux_gueris\": 50,
    \"cas_actifs\": 200,
    \"id_pays\": 1,
    \"id_pandemie\": 1,
    \"date\": \"2023-04-09\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/stats/create"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "nouveaux_cas": 100,
    "nouveaux_deces": 5,
    "nouveaux_gueris": 50,
    "cas_actifs": 200,
    "id_pays": 1,
    "id_pandemie": 1,
    "date": "2023-04-09"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTstats-create">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id_stat&quot;: 1,
    &quot;nouveaux_cas&quot;: 100,
    &quot;nouveaux_deces&quot;: 5,
    &quot;nouveaux_gueris&quot;: 50,
    &quot;cas_actifs&quot;: 200,
    &quot;id_pays&quot;: 1,
    &quot;id_pandemie&quot;: 1,
    &quot;date&quot;: &quot;2023-04-09&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTstats-create" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTstats-create"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTstats-create"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTstats-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTstats-create">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTstats-create" data-method="POST"
      data-path="stats/create"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTstats-create', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>stats/create</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTstats-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTstats-create"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nouveaux_cas</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="nouveaux_cas"                data-endpoint="POSTstats-create"
               value="100"
               data-component="body">
    <br>
<p>Le nombre de nouveaux cas. Example: <code>100</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nouveaux_deces</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="nouveaux_deces"                data-endpoint="POSTstats-create"
               value="5"
               data-component="body">
    <br>
<p>Le nombre de nouveaux décès. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nouveaux_gueris</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="nouveaux_gueris"                data-endpoint="POSTstats-create"
               value="50"
               data-component="body">
    <br>
<p>Le nombre de nouveaux guéris. Example: <code>50</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cas_actifs</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cas_actifs"                data-endpoint="POSTstats-create"
               value="200"
               data-component="body">
    <br>
<p>Le nombre de cas actifs. Example: <code>200</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_pays</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id_pays"                data-endpoint="POSTstats-create"
               value="1"
               data-component="body">
    <br>
<p>L'ID du pays. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>id_pandemie</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id_pandemie"                data-endpoint="POSTstats-create"
               value="1"
               data-component="body">
    <br>
<p>L'ID de la pandémie. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="POSTstats-create"
               value="2023-04-09"
               data-component="body">
    <br>
<p>La date de la statistique. Example: <code>2023-04-09</code></p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
