CRUD for products, profile, cart

use modular components header, footer, product cards
create a single page template for products
create an archive for the product page

user profile page


a page to see if the other ones work still, will check these pages:
- single page products
- archive pages
- api checks
	- authentication
	- 



api implementation:
- profile: 
	- get for getting profile, **partially done, needs checking for logged in users**
	- put for updating profile, 
	- post for creating profile **partially done, needs session mgmt**
- cart: 
	- get for getting cart and all the products added, 
	- put for adding items to cart
- products: 
	- get for getting all products or a single product depending on request data, **done**
	- post for adding products (access limited to authorized people only), 
	- put for updating products also limit access
- order: 
	- get for getting order info already placed, 
	- post for placing order, 
	- put for updating it through admin side **probably won't implement this as it is unnecessary for this assignment**



