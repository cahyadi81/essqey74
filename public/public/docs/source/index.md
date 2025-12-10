---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)
<!-- END_INFO -->

#general
<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## Create a new controller instance.

> Example request:

```bash
curl -X POST "http://localhost:8585/api/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/login`


<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_60ee0986473dfd5c1e5e2e82823469bc -->
## api/slip

> Example request:

```bash
curl -X GET "http://localhost:8585/api/slip" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/slip",
    "method": "GET",
    "headers": {
        "accept": "application/json",
		"Authorization": "Bearer DRPc3NIPJ33pFsyhvkHvZIhBKMZJq1gIAWwb38jBodqtycZl7pYiukofl7t3ZdkM1TVmbs3E5wvlDwua8GrKMkBU5097dZsnTLuy"
    }
	
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "message": "Trying to get property of non-object",
    "exception": "ErrorException",
    "file": "D:\\PROJECT\\qeyapinew\\app\\Http\\Controllers\\API\\TokenController.php",
    "line": 62,
    "trace": [
        {
            "file": "D:\\PROJECT\\qeyapinew\\app\\Http\\Controllers\\API\\TokenController.php",
            "line": 62,
            "function": "handleError",
            "class": "Illuminate\\Foundation\\Bootstrap\\HandleExceptions",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\app\\Http\\Controllers\\API\\SlipController.php",
            "line": 21,
            "function": "getNikByToken",
            "class": "App\\Http\\Controllers\\API\\TokenController",
            "type": "->"
        },
        {
            "function": "index",
            "class": "App\\Http\\Controllers\\API\\SlipController",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Controller.php",
            "line": 54,
            "function": "call_user_func_array"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\ControllerDispatcher.php",
            "line": 45,
            "function": "callAction",
            "class": "Illuminate\\Routing\\Controller",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
            "line": 212,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\ControllerDispatcher",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Route.php",
            "line": 169,
            "function": "runController",
            "class": "Illuminate\\Routing\\Route",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 658,
            "function": "run",
            "class": "Illuminate\\Routing\\Route",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Middleware\\SubstituteBindings.php",
            "line": 41,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken.php",
            "line": 67,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\View\\Middleware\\ShareErrorsFromSession.php",
            "line": 49,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\View\\Middleware\\ShareErrorsFromSession",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Session\\Middleware\\StartSession.php",
            "line": 63,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Session\\Middleware\\StartSession",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse.php",
            "line": 37,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Cookie\\Middleware\\EncryptCookies.php",
            "line": 59,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Cookie\\Middleware\\EncryptCookies",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 660,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 635,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 601,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Router.php",
            "line": 590,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php",
            "line": 176,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 30,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\fideloper\\proxy\\src\\TrustProxies.php",
            "line": 56,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest.php",
            "line": 30,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode.php",
            "line": 46,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 149,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\CheckForMaintenanceMode",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Routing\\Pipeline.php",
            "line": 53,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Pipeline\\Pipeline.php",
            "line": 102,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php",
            "line": 151,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Http\\Kernel.php",
            "line": 116,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\mpociot\\laravel-apidoc-generator\\src\\Mpociot\\ApiDoc\\Generators\\LaravelGenerator.php",
            "line": 116,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\mpociot\\laravel-apidoc-generator\\src\\Mpociot\\ApiDoc\\Generators\\AbstractGenerator.php",
            "line": 98,
            "function": "callRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\mpociot\\laravel-apidoc-generator\\src\\Mpociot\\ApiDoc\\Generators\\LaravelGenerator.php",
            "line": 58,
            "function": "getRouteResponse",
            "class": "Mpociot\\ApiDoc\\Generators\\AbstractGenerator",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\mpociot\\laravel-apidoc-generator\\src\\Mpociot\\ApiDoc\\Commands\\GenerateDocumentation.php",
            "line": 261,
            "function": "processRoute",
            "class": "Mpociot\\ApiDoc\\Generators\\LaravelGenerator",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\mpociot\\laravel-apidoc-generator\\src\\Mpociot\\ApiDoc\\Commands\\GenerateDocumentation.php",
            "line": 83,
            "function": "processLaravelRoutes",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "function": "handle",
            "class": "Mpociot\\ApiDoc\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php",
            "line": 29,
            "function": "call_user_func_array"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php",
            "line": 87,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\BoundMethod.php",
            "line": 31,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php",
            "line": 549,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php",
            "line": 183,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\symfony\\console\\Command\\Command.php",
            "line": 252,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Command.php",
            "line": 170,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\symfony\\console\\Application.php",
            "line": 946,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\symfony\\console\\Application.php",
            "line": 248,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\symfony\\console\\Application.php",
            "line": 148,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Console\\Application.php",
            "line": 88,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Console\\Kernel.php",
            "line": 121,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "D:\\PROJECT\\qeyapinew\\artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```

### HTTP Request
`GET api/slip`

`HEAD api/slip`


<!-- END_60ee0986473dfd5c1e5e2e82823469bc -->
<!-- START_fd1b6d20e80883142045970e8ab47d7f -->
## api/cuti

> Example request:

```bash
curl -X GET "http://localhost:8585/api/cuti" \
-H "Accept: application/json"
```

```javascript
var form = new FormData();
form.append("ajuan_cuti", "CT");
form.append("tgl_from", "06-04-2018");
form.append("tgl_to", "11-04-2018");
form.append("alasan", "jalan-jalan");
form.append("no_hp", "087871056560");
form.append("alamat", "keroncong permai");

var settings = {
  "async": true,
  "crossDomain": true,
  "url": "http://localhost:8585/api/cuti/",
  "method": "GET",
  "headers": {
    "Accept": "application/json",
    "Authorization": "Bearer DRPc3NIPJ33pFsyhvkHvZIhBKMZJq1gIAWwb38jBodqtycZl7pYiukofl7t3ZdkM1TVmbs3E5wvlDwua8GrKMkBU5097dZsnTLuy",
    "Cache-Control": "no-cache",
    "Postman-Token": "a4f0ff10-aed7-4f94-a094-186a6c418444"
  },
  "processData": false,
  "contentType": false,
  "mimeType": "multipart/form-data",
  "data": form
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "status": "token expired or not valid"
}
```

### HTTP Request
`GET api/cuti`

`HEAD api/cuti`


<!-- END_fd1b6d20e80883142045970e8ab47d7f -->
<!-- START_20f9d26b0244ce94732172877b691023 -->
## api/cuti/detail

> Example request:

```bash
curl -X GET "http://localhost:8585/api/cuti/detail" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/cuti/detail",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "header": {
        "module": "data detail cuti",
        "nik": "20150422"
    },
    "data": []
}
```

### HTTP Request
`GET api/cuti/detail`

`HEAD api/cuti/detail`


<!-- END_20f9d26b0244ce94732172877b691023 -->

<!-- START_e433db92ecf8da9696511ea6c155e348 -->
## api/cuti/request

> Example request:

```bash
curl -X POST "http://localhost:8585/api/cuti/request" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/cuti/request",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/cuti/request`


<!-- END_e433db92ecf8da9696511ea6c155e348 -->

<!-- START_1990c043265711daac475c415534c4b4 -->
## api/cuti/approved

> Example request:

```bash
curl -X POST "http://localhost:8585/api/cuti/approved" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/cuti/approved",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/cuti/approved`


<!-- END_1990c043265711daac475c415534c4b4 -->

<!-- START_25874080360f08dd8114be2938356f68 -->
## api/izin

> Example request:

```bash
curl -X GET "http://localhost:8585/api/izin" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/izin",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "header": {
        "module": "data izin",
        "nik": "20150422"
    },
    "data": [
        {
            "nik": null,
            "jumlah": 0
        }
    ]
}
```

### HTTP Request
`GET api/izin`

`HEAD api/izin`


<!-- END_25874080360f08dd8114be2938356f68 -->

<!-- START_3bb4690c504bf1da67d7b0563e8c60c3 -->
## api/izin/detail

> Example request:

```bash
curl -X GET "http://localhost:8585/api/izin/detail" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/izin/detail",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "header": {
        "module": "data izin",
        "nik": "20150422"
    },
    "data": []
}
```

### HTTP Request
`GET api/izin/detail`

`HEAD api/izin/detail`


<!-- END_3bb4690c504bf1da67d7b0563e8c60c3 -->

<!-- START_40e05ffcd79e5cfb7637d4c33de97aa6 -->
## api/absensi

> Example request:

```bash
curl -X GET "http://localhost:8585/api/absensi" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/absensi",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "header": {
        "module": "data absensi",
        "nik": "20150422",
        "periode": "ALL"
    },
    "data": [
        {
            "nik": "20150422",
            "periode": 201701,
            "hk": 22,
            "hke": 23
        },
        {
            "nik": "20150422",
            "periode": 201702,
            "hk": 20,
            "hke": 22
        },
        {
            "nik": "20150422",
            "periode": 201703,
            "hk": 20,
            "hke": 20
        },
        {
            "nik": "20150422",
            "periode": 201704,
            "hk": 19,
            "hke": 20
        },
        {
            "nik": "20150422",
            "periode": 201705,
            "hk": 18,
            "hke": 22
        },
        {
            "nik": "20150422",
            "periode": 201706,
            "hk": 16,
            "hke": 19
        },
        {
            "nik": "20150422",
            "periode": 201710,
            "hk": 6,
            "hke": 21
        },
        {
            "nik": "20150422",
            "periode": 201711,
            "hk": 20,
            "hke": 22
        }
    ]
}
```

### HTTP Request
`GET api/absensi`

`HEAD api/absensi`


<!-- END_40e05ffcd79e5cfb7637d4c33de97aa6 -->

<!-- START_f35ad00bd0407e01e01b8b4aae4aa00f -->
## api/absensi/detail

> Example request:

```bash
curl -X GET "http://localhost:8585/api/absensi/detail" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/absensi/detail",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "header": {
        "module": "data detail absensi",
        "nik": "20150422",
        "periode": "ALL"
    },
    "data": [
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-19",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-20",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-21",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-22",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-23",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-24",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-25",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-26",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "1",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-27",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-28",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-29",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-30",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2016-12-31",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-01",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-02",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-03",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-04",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-05",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-06",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-07",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-08",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-09",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-10",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-11",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-12",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-13",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-14",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-15",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-16",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-17",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "tgl": "2017-01-18",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-19",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:37"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-20",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:37"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-21",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:38"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-22",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:39"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-23",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:40"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-24",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-25",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-26",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:43"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-27",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:44"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-28",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:44"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-29",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:45"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-30",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:46"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-01-31",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:47"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-01",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-02",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:49"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-03",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:50"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-04",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:50"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-05",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-06",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:52"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-07",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:53"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-08",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "1",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:54"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-09",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "1",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-10",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-11",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:57"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-12",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:57"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-13",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:58"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-14",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:59"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-15",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:39:00"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-16",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:39:01"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-17",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:39:02"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "tgl": "2017-02-18",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:39:03"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-02-19",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:54"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-02-20",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:54"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-02-21",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-02-22",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-02-23",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-02-24",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-02-25",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-02-26",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-02-27",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-02-28",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-01",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-02",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-03",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-04",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-05",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-06",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-07",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-08",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-09",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-10",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-11",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-12",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-13",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-14",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-15",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-16",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-17",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:56"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "tgl": "2017-03-18",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:57"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-19",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:06:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-20",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:06:50"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-21",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:06:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-22",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:06:53"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-23",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:06:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-24",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:06:57"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-25",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:06:58"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-26",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:00"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-27",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:02"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-28",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:03"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-29",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:05"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-30",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:07"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-03-31",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:08"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-01",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:10"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-02",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:12"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-03",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:14"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-04",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:16"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-05",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:17"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-06",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:19"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-07",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:21"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-08",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:22"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-09",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:24"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-10",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:26"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-11",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:27"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-12",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:29"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-13",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:31"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-14",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:32"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-15",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:34"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-16",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:36"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-17",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "1",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:38"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "tgl": "2017-04-18",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:07:40"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-19",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-20",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-21",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-22",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-23",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-24",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-25",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-26",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-27",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-28",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-29",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-04-30",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-01",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-02",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-03",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-04",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-05",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-06",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-07",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-08",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-09",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-10",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-11",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-12",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "1",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-13",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-14",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-15",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-16",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-17",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "tgl": "2017-05-18",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULER",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-19",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-20",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-21",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-22",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-23",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-24",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-25",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-26",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "1",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-27",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-28",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-29",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-30",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-05-31",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-01",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-02",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-03",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-04",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-05",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "1",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-06",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "1",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-07",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-08",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-09",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-10",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-11",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-12",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-13",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-14",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-15",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-16",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-17",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "tgl": "2017-06-18",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": null,
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-19",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-20",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-21",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "LIBUR",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-22",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-23",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-24",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-25",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-26",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-27",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-28",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-29",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-09-30",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-01",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-02",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-03",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-04",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-05",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-06",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-07",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-08",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-09",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "07:53:46",
            "tmout": "17:21:58",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-10",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "07:57:41",
            "tmout": "17:09:16",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-11",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "07:55:04",
            "tmout": "17:44:37",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-12",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "07:52:54",
            "tmout": "17:18:17",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-13",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "07:54:42",
            "tmout": "17:22:56",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-14",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-15",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-16",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:03:13",
            "tmout": "17:11:57",
            "tipe_krj": "",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-17",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "tgl": "2017-10-18",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-19",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "1",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-20",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "1",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-21",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "BELUM JOIN",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-22",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "BELUM JOIN",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-23",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-24",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-25",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-26",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-27",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-28",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "BELUM JOIN",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-29",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "BELUM JOIN",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-30",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-10-31",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-01",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-02",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-03",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-04",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "BELUM JOIN",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-05",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "BELUM JOIN",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-06",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-07",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-08",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-09",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-10",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-11",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "BELUM JOIN",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-12",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "BELUM JOIN",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-13",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-14",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-15",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-16",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-17",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "08:00:00",
            "tmout": "17:00:00",
            "tipe_krj": "REGULAR",
            "flag_msk": "1",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "tgl": "2017-11-18",
            "tmin_std": "08:00:00",
            "tmout_std": "17:00:00",
            "tmin": "00:00:00",
            "tmout": "00:00:00",
            "tipe_krj": "BELUM JOIN",
            "flag_msk": "0",
            "flag_izn": "0",
            "flag_skt": "0",
            "flag_alf": "0",
            "flag_ovr": "0",
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        }
    ]
}
```

### HTTP Request
`GET api/absensi/detail`

`HEAD api/absensi/detail`


<!-- END_f35ad00bd0407e01e01b8b4aae4aa00f -->

<!-- START_c232eb85e07b1eb27e7ca0594ae406dd -->
## api/absensi/rekap

> Example request:

```bash
curl -X GET "http://localhost:8585/api/absensi/rekap" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/absensi/rekap",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "header": {
        "module": "data rekap absensi",
        "nik": "20150422",
        "periode": "ALL"
    },
    "data": [
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201701,
            "hke": 23,
            "flag_msk": 22,
            "flag_izn": 0,
            "flag_skt": 1,
            "flag_alf": 0,
            "flag_ovr": 0,
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-02-13 16:02:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201702,
            "hke": 22,
            "flag_msk": 20,
            "flag_izn": 0,
            "flag_skt": 2,
            "flag_alf": 0,
            "flag_ovr": 0,
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-03-11 04:38:37"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201703,
            "hke": 20,
            "flag_msk": 20,
            "flag_izn": 0,
            "flag_skt": 0,
            "flag_alf": 0,
            "flag_ovr": 0,
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-04-16 11:27:54"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201704,
            "hke": 20,
            "flag_msk": 19,
            "flag_izn": 0,
            "flag_skt": 1,
            "flag_alf": 0,
            "flag_ovr": 0,
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-05-14 06:06:48"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201705,
            "hke": 22,
            "flag_msk": 18,
            "flag_izn": 0,
            "flag_skt": 1,
            "flag_alf": 0,
            "flag_ovr": 0,
            "site": "",
            "usr_upd": "U4499",
            "lst_upd": "2017-06-15 21:13:55"
        },
        {
            "nik": "20150422",
            "nm_kry": "Dina Irawati",
            "th_bln": 201706,
            "hke": 19,
            "flag_msk": 16,
            "flag_izn": 0,
            "flag_skt": 3,
            "flag_alf": 0,
            "flag_ovr": 0,
            "site": "",
            "usr_upd": "U3985",
            "lst_upd": "2017-06-21 16:17:42"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201710,
            "hke": 21,
            "flag_msk": 6,
            "flag_izn": 0,
            "flag_skt": 0,
            "flag_alf": 0,
            "flag_ovr": 0,
            "site": "HO BANDUNG",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:13:51"
        },
        {
            "nik": "20150422",
            "nm_kry": "DINA IRAWATI",
            "th_bln": 201711,
            "hke": 22,
            "flag_msk": 20,
            "flag_izn": 0,
            "flag_skt": 2,
            "flag_alf": 0,
            "flag_ovr": 0,
            "site": "PMA HO",
            "usr_upd": "U4499",
            "lst_upd": "2017-12-26 14:26:41"
        }
    ]
}
```

### HTTP Request
`GET api/absensi/rekap`

`HEAD api/absensi/rekap`


<!-- END_c232eb85e07b1eb27e7ca0594ae406dd -->

<!-- START_cfdcd2cc36281309fb58e252c752e305 -->
## api/karyawan

> Example request:

```bash
curl -X GET "http://localhost:8585/api/karyawan" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/karyawan",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "header": {
        "module": "data karyawan",
        "nik": "20150422"
    },
    "data": [
        {
            "kode_karyawan": "K000003839",
            "nik": "20150422",
            "nama_lengkap": "DINA IRAWATI",
            "foto_karyawan": "",
            "tempat_lahir": "BANDUNG",
            "tanggal_lahir": "1990-01-31",
            "alamat_tinggal": "JL. KEBON JAYANTI NO.20 RT.08 RW.12  KIARACONDONG  BANDUNG 40284",
            "kodepos_tinggal": 40284,
            "alamat_ktp": "JL. KEBON JAYANTI NO.20 RT.08 RW.12  KIARACONDONG  BANDUNG 40284",
            "kodepos_ktp": 40284,
            "jenis_kelamin": "PEREMPUAN",
            "golongan_darah": "A",
            "tinggi_badan": 150,
            "berat_badan": 47,
            "ukuran_baju": "M",
            "suku": "SUNDA",
            "agama": "ISLAM",
            "kebangsaan": "INDONESIA",
            "nomor_passport": "-",
            "output_passport": "-",
            "kadaluarsa_passport": "1970-01-01",
            "telpon_rmh_hp": "082117907316",
            "email": "admbank_pma@pinusmerahabadi.co.id",
            "status_nikah": "MENIKAH",
            "tanggal_nikah": "2016-09-03",
            "nomor_kk": null,
            "nomor_ktp": "3173061011760017",
            "ktp_output": "KOTA BANDUNG",
            "kadaluarsa_ktp": "2018-01-31",
            "no_rekening": "130-0013-97519-1",
            "nama_bank": "MANDIRI",
            "nomor_npwp": "72.337.027.6-424.000",
            "status_pajak": "K0",
            "nomor_bpjs_krj": "15017175389",
            "nomor_bpjs_kes": "0002245063509",
            "nomor_sim_a": "-",
            "output_sim_a": "-",
            "kadaluarsa_sim_a": "1970-01-01",
            "nomor_sim_b": "-",
            "output_sim_b": "-",
            "kadaluarsa_sim_b": "1970-01-01",
            "nomor_sim_c": "9001130555662",
            "output_sim_c": "KOTA BANDUNG",
            "kadaluarsa_sim_c": "2019-01-31",
            "lokasi_kerja": "STE0002",
            "user_update": "20150422",
            "last_update": "2017-02-22 12:02:46",
            "nik_atasan": "15000225",
            "departemen": "E0002",
            "jabatan": "J039",
            "status_karyawan": "TETAP",
            "status_periode_month": "0",
            "grade": "3B",
            "flag_mutasi": "0",
            "id_prop": "02",
            "id_kab": "0273",
            "id_kec": "0273121",
            "id_kel": "0273121104",
            "tanggal_masuk_kerja": "2015-03-06",
            "status_masuk_kerja_tetap": "1970-01-01",
            "status_masuk_kerja_kontrak1": "1970-01-01",
            "status_masuk_kerja_kontrak2": "1970-01-01",
            "tanggal_promosi": "1970-01-01",
            "jabatan_promosi": "BLANK",
            "tanggal_mutasi": "1970-01-01",
            "jabatan_mutasi": "BLANK",
            "lokasi_mutasi": "",
            "tanggal_terminasi": "1970-01-01",
            "alasan_resign": "-",
            "periode_of_contract": "-",
            "kd_customer": "NC001",
            "slip_flag": "TRANSFER",
            "PROPINSI": "JAWA BARAT",
            "KECAMATAN": "KIARACONDONG",
            "KABUPATEN": "KOTA BANDUNG",
            "KELURAHAN": "KEBUN JAYANTI",
            "nm_customer": "PT. PINUS MERAH ABADI (HO)",
            "nm_lokasi_kerja": "PMA H O BANDUNG",
            "type_lokasi_kerja": "HO",
            "nm_jabatan": "FINANCE STAFF",
            "url_foto": "0"
        }
    ]
}
```

### HTTP Request
`GET api/karyawan`

`HEAD api/karyawan`


<!-- END_cfdcd2cc36281309fb58e252c752e305 -->

<!-- START_fbc016b20ca231fa168be8bc1db181a0 -->
## api/karyawan/pendidikan

> Example request:

```bash
curl -X GET "http://localhost:8585/api/karyawan/pendidikan" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/karyawan/pendidikan",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "header": {
        "module": "data pendidikan karyawan",
        "nik": "20150422"
    },
    "data": [
        {
            "kode_karyawan": "K000003839",
            "flag_formal_non_formal": "FORMAL",
            "jenis_sekolah": "POLITEKNIK",
            "nama_sekolah": "PKN LPKIA",
            "lokasi": "BANDUNG",
            "fakultas": "D3",
            "tgl_awal_pendidikan": "2008",
            "tgl_akhir_pendidikan": "2011",
            "status_kelulusan": "LULUS",
            "nilai_ipk": "20-02-2017",
            "gelar": "LAINNYA",
            "setifikat": "ADA",
            "last_update": "2017-02-22 12:02:46",
            "user_update": "20150422"
        }
    ]
}
```

### HTTP Request
`GET api/karyawan/pendidikan`

`HEAD api/karyawan/pendidikan`


<!-- END_fbc016b20ca231fa168be8bc1db181a0 -->

<!-- START_1fadc62e045de058e62e0e409c6d564d -->
## api/karyawan/keluarga

> Example request:

```bash
curl -X GET "http://localhost:8585/api/karyawan/keluarga" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/karyawan/keluarga",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "header": {
        "module": "data keluarga karyawan",
        "nik": "20150422"
    },
    "data": [
        {
            "kode_karyawan": "K000003839",
            "hubungan_keluarga": "AYAH\/IBU",
            "no_ktp": null,
            "jenis_kelamin": "LAKI-LAKI",
            "nama": "SUBIYANTO",
            "tempat_lahir": "PURWOREJO",
            "tanggal_lahir": "1954-08-26",
            "pendidikan": "SMK",
            "pekerjaan": "WIRASWASTA",
            "nomor_telepon": "082126585248",
            "last_update": "2017-02-22 12:02:46",
            "user_update": "20150422"
        },
        {
            "kode_karyawan": "K000003839",
            "hubungan_keluarga": "AYAH\/IBU",
            "no_ktp": null,
            "jenis_kelamin": "PEREMPUAN",
            "nama": "SITI AMINAH",
            "tempat_lahir": "BANDUNG",
            "tanggal_lahir": "1961-02-21",
            "pendidikan": "S1",
            "pekerjaan": "PNS GURU SD",
            "nomor_telepon": "082126585248",
            "last_update": "2017-02-22 12:02:46",
            "user_update": "20150422"
        },
        {
            "kode_karyawan": "K000003839",
            "hubungan_keluarga": "SUAMI\/ISTRI",
            "no_ktp": null,
            "jenis_kelamin": "LAKI-LAKI",
            "nama": "AGUNG GUSTIMAN",
            "tempat_lahir": "BANDUNG",
            "tanggal_lahir": "1990-08-04",
            "pendidikan": "D3",
            "pekerjaan": "KARYAWAN BUMN",
            "nomor_telepon": "082118497477",
            "last_update": "2017-02-22 12:02:46",
            "user_update": "20150422"
        },
        {
            "kode_karyawan": "K000003839",
            "hubungan_keluarga": "ADIK",
            "no_ktp": null,
            "jenis_kelamin": "PEREMPUAN",
            "nama": "LUSI NURMALASARI",
            "tempat_lahir": "BANDUNG",
            "tanggal_lahir": "1991-09-06",
            "pendidikan": "S1",
            "pekerjaan": "KARYAWAN SWASTA",
            "nomor_telepon": "085624682893",
            "last_update": "2017-02-22 12:02:46",
            "user_update": "20150422"
        },
        {
            "kode_karyawan": "K000003839",
            "hubungan_keluarga": "KAKAK",
            "no_ktp": null,
            "jenis_kelamin": "LAKI-LAKI",
            "nama": "TOMMY IRAWAN",
            "tempat_lahir": "BANDUNG",
            "tanggal_lahir": "1988-03-29",
            "pendidikan": "S1",
            "pekerjaan": "HONORER PNS",
            "nomor_telepon": "085721540329",
            "last_update": "2017-02-22 12:02:46",
            "user_update": "20150422"
        }
    ]
}
```

### HTTP Request
`GET api/karyawan/keluarga`

`HEAD api/karyawan/keluarga`


<!-- END_1fadc62e045de058e62e0e409c6d564d -->

<!-- START_dcf9aabb0fb858af28a5aab22cecf48e -->
## api/karyawan/organisasi

> Example request:

```bash
curl -X GET "http://localhost:8585/api/karyawan/organisasi" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/karyawan/organisasi",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "header": {
        "module": "data pengalaman organisasi karyawan",
        "nik": "20150422"
    },
    "data": [
        {
            "kode_karyawan": "K000003839",
            "nama_organisasi": "-",
            "tahun_organisasi": "-",
            "jabatan": "-",
            "catatan": "-",
            "last_update": "2017-02-22 12:02:46",
            "user_update": "20150422"
        }
    ]
}
```

### HTTP Request
`GET api/karyawan/organisasi`

`HEAD api/karyawan/organisasi`


<!-- END_dcf9aabb0fb858af28a5aab22cecf48e -->

<!-- START_08f144b8568c0dce89cfdc43ab3e5429 -->
## api/karyawan/pengalaman_kerja

> Example request:

```bash
curl -X GET "http://localhost:8585/api/karyawan/pengalaman_kerja" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8585/api/karyawan/pengalaman_kerja",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "header": {
        "module": "data pengalaman kerja karyawan",
        "nik": "20150422"
    },
    "data": [
        {
            "kode_karyawan": "K000003839",
            "nama_perusahaan": "PT JAYAMAS DWI PERKASA",
            "alamat_perusahaan": "JALAN KIARACONDONG NO 260 A",
            "kota": "BANDUNG",
            "telepon": "-",
            "jabatan_terakhir": "STAF PAJAK",
            "tanggal_masuk": "2013",
            "tanggal_keluar": "2014",
            "alasan_keluar": "MENCARI SUASANA BARU",
            "nama_atasan": "FHUI CUI",
            "gaji_terakhir": 2300,
            "last_update": "2017-02-22 12:02:46",
            "user_update": "20150422",
            "job": "MEMBUAT FAKTUR PAJAK\r\nMEREKAP DATA BIAYA-BIAYA DAN LAP PERS\r\nMELAKUKAN KONSULTASI BERSAMA PAJAK"
        },
        {
            "kode_karyawan": "K000003839",
            "nama_perusahaan": "PT JAYAMAS DWI PERKASA",
            "alamat_perusahaan": "KOMP BATUNUNGGAL",
            "kota": "BANDUNG",
            "telepon": "",
            "jabatan_terakhir": "STAF ACCOUNTING PAJAK",
            "tanggal_masuk": "2011",
            "tanggal_keluar": "2013",
            "alasan_keluar": "mencari suasana baru",
            "nama_atasan": "SUGIHARTO",
            "gaji_terakhir": 1700,
            "last_update": "2017-02-22 12:02:46",
            "user_update": "20150422",
            "job": "MEMBUAT FAKTUR PAJAK\r\nMEREKAP DATA BIAYA-BIAYA DAN LAP PERS\r\nMELAKUKAN KONSULTASI BERSAMA PAJAK"
        },
        {
            "kode_karyawan": "K000003839",
            "nama_perusahaan": "CV MULTIJASA (KONSULTAN PAJAK)",
            "alamat_perusahaan": "JALAN KIARACONDONG NO 260 A",
            "kota": "BANDUNG",
            "telepon": "-",
            "jabatan_terakhir": "STAF PAJAK",
            "tanggal_masuk": "2013",
            "tanggal_keluar": "2014",
            "alasan_keluar": "MENCARI SUASANA BARU",
            "nama_atasan": "FHUI CUI",
            "gaji_terakhir": 2300,
            "last_update": "2017-02-22 12:02:46",
            "user_update": "20150422",
            "job": "Membuat lap keu\r\nmembuat perhitungan wp op badan\r\nmembuat lap pjk bulanan"
        },
        {
            "kode_karyawan": "K000003839",
            "nama_perusahaan": "CV MULTIJASA (KONSULTAN PAJAK)",
            "alamat_perusahaan": "KOMP BATUNUNGGAL",
            "kota": "BANDUNG",
            "telepon": "",
            "jabatan_terakhir": "STAF ACCOUNTING PAJAK",
            "tanggal_masuk": "2011",
            "tanggal_keluar": "2013",
            "alasan_keluar": "mencari suasana baru",
            "nama_atasan": "SUGIHARTO",
            "gaji_terakhir": 1700,
            "last_update": "2017-02-22 12:02:46",
            "user_update": "20150422",
            "job": "Membuat lap keu\r\nmembuat perhitungan wp op badan\r\nmembuat lap pjk bulanan"
        }
    ]
}
```

### HTTP Request
`GET api/karyawan/pengalaman_kerja`

`HEAD api/karyawan/pengalaman_kerja`


<!-- END_08f144b8568c0dce89cfdc43ab3e5429 -->

