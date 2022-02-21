# Adddress Book Laravue README

This app is designed to showcase my abilities using php, laravel, and vuejs to create and store contacts and their related addresses to a database. Eventually, it will also include the ability for each user to have their own personalized address book.

## Requirements

- Must allow the user to create, edit and delete contacts
- Must allow the user to create, edit and delete addressess related to the correct contact
- Deleting a contact deletes all associated addressess
- Deleting an address only affects that address   
- User friendly and intuitive userface
- User friendly algolia instant-search

## Installation

Installing the app:

1. clone the Git repo
2. run composer update
3. Run npm install && npm run dev
4. run php artisan migrate --seed
5. run php artisan serve

## Dependancies
1. npm install vue
2. npm install vue-router
3. npm install carbon
4. npm install view-design --save
5. npm install --save vue-instantsearch

### File Structure

All files are located in the resources/js/ folder
1. Pages
    1. Contacts
        - index.vue => loads the contacts list with action buttons
            - data: contact.id, contact.firstName, contact.lastName, contact.email, contact.phone, contact. birthday
        - createContact.vue => loads a form for adding a new contact
        - editContact.vue => loads a form with current contact data and saves any changes
            - data: contact.id, contact.firstName, contact.lastName, contact.email, contact.phone, contact. birthday
        - deleteContact.vue => first ask for confirmation then deletes a contact and all of the associated addresses
            - data: contact.id, contact.firstName, contact.lastName, contact.email, contact.phone, contact. birthday
    2. Addresses
        - index.vue => loads the current contact data and addresses
            - data: contact.id, contact.firstName, contact.lastName, contact.email, contact.phone, contact. birthday, contact.address (all address data where the address contact.id foreign key is the same as the current contact id)
        - createAddress.vue => form for creating a new address under the current contact
        - editAddress.vue => form with current contact data and saves any changes
        - deleteAddress.vue => asks for confirmation and then deletes the address data
    3. Future Updates
        - Login with authentication
        - personal user dashboard and address book
2. Routes
    1. vue routes are stored in router.js
    2. All AJAX routes are stored in commonajax.js
    3. Both have all routes named the same as the web page with the acception of address/index.vue which is called as 'details'
3. Database
    1. This uses a mysql database (please ensure to update the .env file with your database information)
    2. Two tables
        1. Contacts
            - fields
                - firstName str
                - lastName str
                - email str
                - phone str
                - birthday date yyyy-mm-dd
        2. Addresses
            - fields
                - number int
                - street str
                - city str
                - state str
                - zip int
                - contact_id (foreign key to the contact table)

## Known Issues

- still in development

## Future work

- Add user authentication
- Add personal address books

## Release Notes

### 1.0.0

unreleased

## Contact us

<a href="mailto:carlos.s.aragon12@gmail.com" rel="noreferrer noopener">Carlos Aragon</a>

