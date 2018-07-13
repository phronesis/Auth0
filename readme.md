Auth0 SSO Extension
===================
This is a Magento2 extension that adds the ability to log into your Magento installation using Auth0

Facts
-----
- version: 0.3.0
- extension key: DavidUmoh_Auth0
- [extension on GitHub](https://github.com/phronesis/Auth0)


Description
-----------
This is an extension that adds the ability to log into your Magento application using Auth0

Requirements
------------
- PHP >= 5.6.0


Compatibility
-------------
- Magento >= 2.0

## Releases

### v0.1.0
 - First release, users can log into magento using Auth0 as authentication server
### v0.1.1
  - Removed the use of custom attributes as it was not really used and was causing issues during new installations. Will re-visit custom attributes when the use case becomes strong.
### 0.1.3
 - Added option for silent authentication

### 0.1.4
 - Bug fixes
### 0.1.5
 - Added the functionality to retrieve name from Auth0 user based on a config value. See [Issue #11](https://github.com/phronesis/Auth0/issues/11)
### 0.1.6
 - Bug fixes
### 0.1.7
 - Bug fixes

### 0.2.0
 - Implemented ability to specify login redirect url

### 0.3.0
 - Updated dependencies to work with magento 2.2.x 
 - Updated Auth0Lock to v11
 - Implemented Scopes as Config Option. See [Issue #1](https://github.com/phronesis/Auth0/issues/1)
 - Implemented Selector for link that triggers modal as a config option. See [Issue #2](https://github.com/phronesis/Auth0/issues/2)

Installation Instructions
-------------------------
<<<<<<< HEAD
1. Add the repository key to your composer.json:
```
"repositories": {
        "davidumoh-auth0-sso": {
            "type": "vcs",
            "url": "https://github.com/phronesis/Auth0.git"
        }
 }
```
2. Run `composer require davidumoh/module-auth0`
=======

Run `composer require davidumoh/module-auth0`
>>>>>>> release/0.3.0

Uninstallation
--------------
Remove all extension files from your Magento installation


Support
-------
If you have any issues with this extension, open an issue on [GitHub](https://github.com/phronesis/Auth0/issues).

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developer
---------
David Umoh
[http://www.davidumoh.com](http://www.davidumoh.com)
[@umohdave](https://twitter.com/@umohdave)

Licence
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------
(c) 2018 David Umoh
