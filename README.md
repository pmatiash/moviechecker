Test app MovieChecker based on YIInitializr-basic
=======
## Description

* 2 models: Users & Movie.
* Login & really simple registration. Only allowed users will be login. I don't save password as is, only hash (with sold).
* Access rules. Deny all inside pages for non authorized.
* Movie list update with Ajax. Checking for new movies.
* URL routing (e.g. alias "/list" instead "module/controller/action").
* Video was embedded through simple html tags <object> instead html5 tag <video>


## Deployment
=======

* pull repo
* make access rules for assets & runtime folders
* run initial migrate

## Original Structure

```
   |-app
   |---cli
   |-----commands
   |-----migrations
   |---config
   |-----env
   |---controllers
   |---extensions
   |-----behaviors
   |-----components
   |---helpers
   |---lib #it will hold composer 'vendor' folder
   |-----Yiinitializr
   |-------Cli
   |-------Composer
   |-------Helpers
   |-------config
   |---messages
   |---models
   |---modules
   |---views
   |-----layouts
   |-----site
   |---widgets
   |-www
   |---css
   |-----fonts
   |---img
   |---js
   |-----libs
```

For more information about Yiinitializr please check it at [its github repo](https://github.com/2amigos/yiinitializr).
