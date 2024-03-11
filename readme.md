SportsPro Technical Support App

A web app that tracks incidents, customers, products, and technicians for SportsPro
software.

Database Setup

1. Start MySQL or MariaDB server.
2. Use a database management system to run tech_support.sql as the root user
3. After creating the database and its tables, log in as ts_user@localhost with password
   'pa55word' to begin using the database

Instructions and Manual Testing
NOTE: Relevant error messages should be displayed for all form fields if there is any
incorrectly formatted data. Test each form by purposely entering invalid formats.

1. Open index.php in a browser.

2. Navigate to 'Manage Products' to test adding and deleting a product.

3. Navigate to 'Technician Manager' to test adding and deleting a technician.

4. Navigate to 'Manage Customers' to test searching, adding, and updating a customer. The country
   dropdown should also default to 'Canada' when adding a customer, or the customer's country when
   updating.

5. Navigate to 'Create Incident' to test adding an incident for a customer.

6. Navigate to 'Register Product' to test registering a product for a particular customer.
