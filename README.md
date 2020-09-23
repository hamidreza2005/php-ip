
# PHP IP 
this package helps you to find client's location by IP address in PHP🚀 
## installation 
you can install this package via Composer :     
```bash    
composer require hamidreza2005/php-ip    
```      
    
## Usage
at first you must initialize your Driver:
```php    
use hamidreza2005\phpIp\Geojs;
use hamidreza2005\phpIp\Ipinfo;
use hamidreza2005\phpIp\Ipapi;

$ip = new Geojs($DebugMode,$IP); //visit https://www.geojs.io/
$ip = new Ipapi(API_TOKEN,$DebugMode,$IP); // visit https://www.ipapi.com/
$ip = new Ipinfo(API_TOKEN,$JSON_FILE_PATH,$DebugMode,$IP); // visit https://www.ipinfo.io/
```        
|Parameter| Explanation  |
|--|--|
|API_TOKEN| your API Token  |
|$JSON_FILE_PATH|[See here](#get-country-fullname-in-ipinfo-driver)|
|$DebugMode|if you ar in debug mode and use localhost make it `true` to get your current ip not `127.0.0.1`|
|$IP|you can use custom ip like `8.8.8.8` instead of using current ip|

and you can use driver's methods :    
```php    
$ip->countryCode() // return country Code e.g DE    
$ip->all() // return all Details about client's ip    
$ip->coordinates() // return client's coordinates    
$ip->ip() // return all client's ip    
$ip->country() // return all client's country full name e.g Germany    
```    
**Notice :** because of every driver have different Structure you should use all method to access Details about IP    

### Get Country fullname in ipinfo driver  
as you know there is not country fullname in ipinfo structure. so if want to use ipinfo driver and you want country fullname `e.g France` you can make a json file where you like and full `$JSON_FILE_PATH` like this :  
```php  
<?php  
use hamidreza2005\phpIp\Ipapi;
$ip = new Ipinfo(API_TOKEN,"./file/path.json")
```  
and for example  `path.json` file must be like this :  
```json  
{     
  "US": "United State",    
  "DE": "Germany"  
}  
```   
Now you can get country fullname by `$ip->country()` in ipinfo driver  
   
## License    
 The MIT License (MIT). Please see [License File](LICENSE.md) for more information.    
    
--------------------    
 ### :raising_hand: Contributing 
 If you find an issue, or have a better way to do something, feel free to open an issue , or a pull request.    
    
### :exclamation: Security 
If you discover any security related issues, please email `h.r.hassani@outlook.com` instead of using the issue tracker.
