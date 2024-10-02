**This is our group project for ITE 387:**
This web application can help students manage and track their budget. We also have a mobile version for this application. 

## Members: 
1. **Sigrae Derf Gabriel**
2. **John Ferry Santiago**
3. **Jaira Braza**
4. **Daniel Zabat Moreno**

# TODOS (BRAZA):

## GIT CLONING
-- gawin mo steps nato para makapag start kana

-> make a folder, kahit saan

-> open mo cmd mo doon sa loob ng folder nayun

-> run mo to: **git clone https://github.com/SDEG77/SMARTBUDGET.git ./**

-> copy mo yung .env.example

-> rename mo yung copy into: .env

-> run mo to sa folder after matapos mag DL: **composer install**

-> again, run mo to pag kayari mag DL: **php artisan key:generate**

-> tapos: **php artisan migrate:fresh --seed**

-> pwede kanang mag simula, yay.

## ALL PAGES NEED NG FIXES AND TOUCH UPS SA FRONT. (YUNG ADMIN SIDE WALA PA FRONTEND)

# TODOS (SIGRAE):


## MISC
--  Recaptcha (+)

-- show password. (+)

-- Input Validation & Sanitazion to combat XSS & SQL injection on all inputs (+)

-- Do the export feature (+)

-- Add paginate with limit of 10 in every page except Dashboard (+)

## PLANNER
-- Do the color samples for each category (+)

-- Make donut display dynamic, it will only show up when data is present inside the chart (+)

## TRACKER
-- Export (+)

-- Delete all (+)

-- Make edit list dropdown immedietly adaptive for income (+)

-- Replace linechart with tally instead with total records. Example: (3,500.00 Total Income | 50 Records) (+)

## DASHBOARD 
-- Make displays dynamic where it will show up only when there is data (+)

-- change income donut color (+)

-- Make sort button active if url is in the specified condition (+)

## PROFILE 
<!-- -- Finished all todos yah00! -->

## FORGOT
-- Do the forgot page (+)

## LEDGER 
-- export file left (+)

# ADMIN (+++)
- DB SEEDER: (INSERT INTO users(full_name, email, password, is_admin) VALUES ('admin', 'admin@secret.com','23456789', true);)
  
## User Management Page (CRUD) (++)

## Resource Management Page (CRUD) (++)
