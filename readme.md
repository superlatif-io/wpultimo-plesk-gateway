# WP Ultimo Plesk Gateway

Plesk gateway integration for domain mapping synchronization between plesk and the WP Ultimo WordPress plugin.

## Getting Started

Install the plugin as usual, this is a network plugin and can only be configured by a user with network admin permissions.

## Configuration

The settings page is available through the network setting tab, you will need to provide the following information:

- Plesk URL, e.g. https://example.com:8443
- The base domain used for domain mapping, e.g. mywebsite.com
- Domain status: define the domain alias status on Plesk
- Synchronize DNS: whether to synchronize the alias with the base domain DNS
- 301 redirect: whether to redirect the alias domain to the base domain (usually not)

### Login informations

You will need to provide your administrator login information, this is done by adding the following constants to your wp-config.php file:

```
define('WPUPG_USER', 'Plesk user');
```
```
define('WPUPG_PASSWORD', 'Plesk password');
```

This way your information are not saved in the database.

### Prerequisites

- Web server running Plesk Onyx
- A domain name on which custom domain will be aliased

## Authors

* **Simon Rapin** - [Superlatif](https://superlatif.io)

## License

This project is licensed under the GNU License - see the [LICENSE](LICENSE) file for details

## Support us!

If you think we saved you some time on your development, please consider showing your appreciation 😁

<a href="https://www.buymeacoffee.com/superlatif" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/v2/default-red.png" alt="Buy Me A Coffee" style="height: 60px !important;width: 217px !important;" ></a>