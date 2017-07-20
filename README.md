# rancherize-publish-traefik-rancher
Sets rancher labels for the traefik rancher backend.

## Difference to the default
The default `traefik` publish type sets label for the `rawmind0/rancher-traefik` confd based traefik config.

## install
In your project using rancherize execute

	vendor/bin/rancherize plugin:install ipunkt/rancherize-publish-traefik-rancher:1.0.0

## Use
The plugin sets the default publish-url.type to `traefik-rancher` so if you have not set this field in your project
environments it will work out of the box.

If you have set the type in your project environments change it to `traefik-rancher` for the environments that should
receive labels for the traefik rancher backend
