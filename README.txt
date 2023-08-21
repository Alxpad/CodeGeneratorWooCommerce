
---Description---

This program generates an unique code after each purchase. This code will generate an unique hash, linked to the order code, and both are stored in "code" table.
The user will receive a mail, with a button heading to an preset URL. This URL calls for a check from the page, using AJAX.

Server will check through GET method if the visit code and hash match with the recorded ones in the database.
If this is the case, it is up to the programmer what comes next.

The javascript code is included as well, into "JS" folder. This code is the one to be included in the site.

-----------

Specifications:

- Wordpress 6.3
- WooCommerce  8.0.2