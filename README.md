# Infi_Care

## About

Wastage of medicines is a global issue. In country like India with such a huge poulation, every year medicines worth billions of dollars gets wasted. Our Vision is to stop this wastage and help our country economically. We plan so by practising three basic things : 
  - **Reuse** : Reusing the medicines which is not yet expired.
  - **Recycle** : Recycling the medicines which is expired or about to expire.
  - **Recirculating** : Recirculating the recycled medicines.

Infi-Care Cares for you and the socitey. It provides customers the platform to submit the unused and expired medicines back to the pharmacies which are collection points. Depending on the medicine submitted, the customer gets points which can be redeemed on future purchases from the pharmacy. The pharmacies will update the record on Infi-Care which will keep track of expired and un-expired Medicines. The expired medicines will be sent back to company through backchain for processing to prevent pollution caused by Medi-Waste. The Medicines which is not expired and can be used will be visible to NGO's who can purchase these medicines from respective pharmacies at a very low price. This will also provide medicines to the sections of socitey which cannot afford it. We have also made a forum kind of thing for the hospitals in the nearby locality within a radius of 5km where they can interact with each other and exchange medicines and blood among each other in the time of need.

## Working

There are 5 types of users in this site :

 - **Customer** :
    * Once, registered as a customer, the user is shown a map with his/her address as the centre of the map. In the radius of 5KM all the nearby pharmacies are    shown which are registered. On clicking the marker of the pharmacies shown, it shows the shortest path form customer's house to that pharmacy. 
    * This also contains a feature of **Availability Of Doctors** in which you have to fill a form of your location, state and type of doctor you want to visit(ex- Dermatologist, Cardiologist etc). It will then search that type of doctor in a radius of 5KM from the address you filled in the form. It will then show you list of all the nearby doctors and you can see their schedule and phone number.
 - **Pharmacy** : Once the customer deposits the medicine, it is segregatted into two sections expired and unexpired. The unexpired medicine is visible to NGO's which can order these. Pharmacy also accepts and delivers the orders from the NGO's. The expired medicine of a particular company say **X** is visible to company **X** which can collect these medicines from pharmacies for treatment.
 - **NGOs** : The user which is registered as NGO will be shown the data of unexpired medicines of all it's nearby pharmacies and can order medicines from any of the pharmacies it likes at a very low price. It can help NGOs to conduct more free clinics.
 - **Company** : The user registered as company will be shown data of all the expired medicines of that particular company in all the pharmacies which has it's supply. The aim is to send back these expired medicines back to company so that it can be treated safely and medi-waste is reduced. Some by-products can also be used for manufacturing of other medicines.
 - **Hospitals** : This user will be shown all the nearby hospitals within a range of 5KM where they can help each other in cases of emergencies like sharing life saving drugs or a rare blood-group type which is currently not available in the hospital. The user can request it's nearby hospital for blood/medicine and set priority to it. If available, the other hospital can send the required things in time as distance is at max 5KM.
 
 
## Tech-Stack

- **Front-end**
  * HTML
  * CSS
  * Bootstrap
 - **Back-end**
    * PHP
    * MySQL database
    * Google Places API
    * Google Search API
    * Google Locations API
  


## Procedure

### Follow the following steps to run this project:-

  - Download the repository.
  - Store it in `htdocs` folder inside `Xampp` folder like `C:\xampp\htdocs`
  - Open `Xampp` and start `Apache` and `MySQL` servers.
  - Open your browser and go for [http://localhost/phpmyadmin/]()
  - Create a new database named `recmeds`.
  - In `recmeds` import the database `recmeds.sql` present in the database folder present in Infi-Care.
  - Open your browser and go for [http://localhost/Infi_Care-master/index.php]()
  - Now Register as different options present in the website and fill the tables in the database
