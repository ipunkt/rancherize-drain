# rancherize-drain
Sets drain_timeout_ms in the rancher-compose.yml of a service

## install
In your project using rancherize execute

	vendor/bin/rancherize plugin:install ipunkt/rancherize-drain:1.0.0

If you're using the docker container then call the following to activate the plugin for a project

	vendor/bin/rancherize plugin:register ipunkt/rancherize-drain

## Use
Full configuration:
```json
{
	"drain": {
		"enable": false,
		"timeout":30
	}
}
```

- Having the `drain` object in your configuration will activate the plugin
- timeout will default to 30 if active but no timeout is given
- enable defaults to TRUE and thus should only be actively set for environments where you want to disable the plugin
