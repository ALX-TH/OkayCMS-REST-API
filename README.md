#<b>Requirements</b> <br>
PHP     > <i>5.5</i> <br>
OkayCMS = <i>any version</i> <br>
Updated database (see: db_update.sql) <br>
Configured timezone in php.ini, like: date.timezone ="Europe/Kiev"

#<b>Description</b> <br>
REST api for <a href="https://okay-cms.com/">OKAYCMS</a> (<a href="http://simplacms.ru/">Simpla CMS</a>) based on
<a href="https://www.slimframework.com/">Slim Framework</a> <br>

#<b>Installation</b> <br>
1) Put file RestAPI.php to api/  directory
2) Add <i>'restapi'   => 'RestAPI'</i> to api/Okay.php
3) Add to .htaccess file: RewriteRule ^rest/(.*)$ lib/RESTfull/v1/api/public/index.php [L,QSA]
4) Copy code to lib/RESTfull/

#<b>Available methods and parameters</b> <br>
<b>Products</b>: <br>
     rest/products/ <br>
     rest/products/id/{id} <br>
     rest/products/category_id/{id} <br>
     rest/products/brand_id/{id} <br>
     rest/products/featured/{0|1} <br>
     rest/products/discounted/{0|1} <br>
     rest/products/in_stock/{0|1} <br>
     rest/products/has_images/{0|1} <br>
     URL parameters: <i>limit, page, id, category_id, brand_id, featured, discounted, in_stock, has_images</i>
     
<b>Product</b>: <br>
     /rest/product/{url} <br>
     /rest/product/{id} <br>
     URL parameters: <i>none</i>
     
<b>Brands</b>: <br>     
     rest/brands/ <br>
     rest/brands/category_id/{id} <br>
     rest/brands/product_id/{id} <br>
     URL parameters: <i>visible, visible_brand, product_id, category_id</i>
     
<b>Brand</b>: <br>
      /rest/brand/{url} <br>
      /rest/brand/{id} <br>
      URL parameters: <i>none</i>
      
<b>Categories</b>: <br>
     rest/categoreies/ <br>
     rest/categoreies/product_id/{id} <br>
     rest/categoreies/level_depth/{level}  <br>
     URL parameters: <i>product_id, parent_id, level_depth</i>

<b>Variants</b>: <br>
     /rest/variants/product_id/{id}
     /rest/variants/id/{id}
     /rest/variants/in_stock/{0|1}
     URL parameters: <i>product_id, id, in_stock</i>