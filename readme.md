Auth0 SSO Extension
===================
This is a Magento2 extension that adds the ability to log into your Magento installation using Auth0

Facts
-----
- version: 0.1.0
- extension key: DavidUmoh_SSO
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
### v0.1.1
 - Bug fixes

Installation Instructions
-------------------------
1. Add the repository key to your composer.json:
```
"reositories": {
        "davidumoh-auth0-sso": {
            "type": "vcs",
            "url": "https://github.com/phronesis/Auth0.git"
        }
 }
```
2. Run `composer require davidumoh/module-auth0`

Uninstallation
--------------
1. Remove all extension files from your Magento installation


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
(c) 2017 David Umoh
