## **This is our group project for ITE 387:**

**This web application can help students manage and track their budget. We also have a mobile version for this application.** 

|                     MEMBERS                    |
|------------------------------------------------|
|1. **Sigrae Derf Gabriel - Backend Developer**  |
|2. **John Ferry Santiago - Project Manager**    |
|3. **Jaira Braza - Frontend Developer**         |
|4. **Daniel Zabat Moreno - Quality Assurance**  |

---

# TODOS (BRAZA):
-- ADMIN SIGNUP: ```'admin@secret.com' (email) and '23456789' (password)```q

## GIT CLONING
-- gawin mo steps nato para makapag start kana

-> make a folder, kahit saan

-> open mo cmd mo doon sa loob ng folder nayun

-> run mo to: 
```git clone https://github.com/SDEG77/SMARTBUDGET.git ./```

-> copy mo yung ```.env.example```

-> rename mo yung copy into: ```.env```

-> run mo to sa folder after matapos mag DL: ```composer install```

-> again, run mo to pag kayari mag DL: 
```php artisan key:generate```

-> tapos: 
```php artisan migrate:fresh --seed```

-> pwede kanang mag simula, yay.

## ALL PAGES NEED NG FIXES AND TOUCH UPS SA FRONT. 

---

# TODOS (SIGRAE):

## MISC
- [ ]  Recaptcha (+)

- [ ] Make pdf files support the Philippine Peso Symbol (+)

- [ ] show password. (+)

- [ ] Input Validation & Sanitazion to combat XSS & SQL injection on all inputs (+)

- [ ] Add paginate with limit of 10 in every page except Dashboard (+)


## PLANNER
- [ ] Do the color samples for each category (+)

- [ ] Make donut display dynamic, it will only show up when data is present inside the chart (+)

## TRACKER
- [ ] Delete all (+)

- [ ] Make edit list dropdown immedietly adaptive for income (+)
  
```Example: (3,500.00 Total Income | 50 Records)``` (+)

## DASHBOARD 
- [ ] Make displays dynamic where it will show up only when there is data (+)

- [ ] change income donut color (+)

- [ ] Make sort button active if url is in the specified condition (+)

## PROFILE 
- [x] Finished
<!-- -- Finished all todos yah00! -->

## FORGOT
- [ ] Do the forgot page (+)

## LEDGER 
- [ ] Delete all (+)

---

## ADMIN TODOS
DB SEEDER:
```
INSERT INTO users(full_name, email, password, is_admin) 
VALUES ('admin', 'admin@secret.com','23456789', true);
```

- [ ] Paginate all of the tables (+)
- [ ] ~~Find a way to make the category work (+)~~
