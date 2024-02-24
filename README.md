# Atom PHP Framework


Atom is fast PHP micro-framework for building web applications  designed to have a minimal footprint
 Speed is a key feature,

## Installion 
download project and got to root and run this command 
<pre>
composer install
</pre>

## Routing 

Routing in Atom is Dynamic route depend On path Of Url 
<pre>
https://www.domain.com/controller/action/parm1/parm2.../parm N;
</pre>
if request url like www.domain.com/user/show/1
then atom frame work will call 
show  action in controlle UserConttoller and send parameter 1
## Events 

there is two built in events [befor Action ] [Aftter Action] is trigger auto
```php
<?php 
 public $events=[
        'beforAction'=>[
            'postLogin'=>'attempts',
        ],
        'AftterAction'=>[
            'register'=>'NotifcationNewUser,send_sms,send_email',
            'postLogin'=>'lastLogin',
        ],
    ];
?>
```

## middleware

```php
<?php 
    public $middleware = ['token','RBAC'];
?>
```
## ORM

idiorm is core of orm in atom framework you can change to your  preferred orm
