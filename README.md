## SKPI
Website untuk pengumpulan data surat keterangan pendamping ijazah

## Install
```
$ composer install
$ npm install
$ npm run dev
```

## Changelog
v0.6.3
- Block access if student has filled the form
- Success message added

v0.6
- Form filling worked
- File uploads done

v0.5
- Form filling validation added

v0.4.9
- certificate type and version migrations added
- SKPI form certificate version added

v0.4.8.6
- auth language -> indonesia
- placeholder colour changed

v0.4.8.5
- student nav link updated
- student profile view updated
- student form view updated

v0.4.8
- user type session added
- user name session added
- user picture session added
- admin can now login with google too
- user student now has it is own picture

v0.4.7.9
- admin navbar design update

v0.4.7.8
- admin menu update
- minor fix

v0.4.7.7
- google login update, if user is not exists in DB then auth failed
- SKPI Collection CRUD -> search

v0.4.7.5
- SKPI Collection CRUD -> update
- SKPI Collection CRUD -> delete
- SKPI Collection, if collection data is empty then delete button is available

v0.4.7.1
- SKPI Collection CRUD -> Create

v0.4.7
- Admin menus changed
- Student CRUD added
- Ajax search student added
- Ajax live nrp check added

v0.4.6
- Admin link menus modified
- Student management view added
- Lecturer management view added
- SKPI management view added
- Student Controller modified
- Student middleware updated -> redirect if admin trying to access student index
- Admin middleware updated -> redirect if student trying to access admin dashboard

v0.4.2
- Index Admin view added
- SkpiData model modified

v0.4.1
- Index Student View added

v0.4 
- Eloquent relationship User model one to one -> Student Model
- Eloquent relationship Student model one to one -> CollectionDetail Model
- Eloquent relationship Student model one to one -> SkpiData Model
- Eloquent relationship SkpiCollection model one to many -> SkpiData Model
- Eloquent relationship SkpiCollection model one to many -> SkpiFile Model
- Eloquent relationship SkpiCollection model one to many -> CollectionDetail Model
- Eloquent relationship SkpiData model one to one -> SkpiFile Model
- Eloquent relationship SkpiData model many to one -> Lecturer Model
- Eloquent relationship SkpiData model one to many -> ActivityData Model
- Eloquent relationship ActivityData model one to one -> ActivityFile Model
- update create_collection_details migrations -> student relation one to one updated

v0.3
- Student middleware added
- Admin middleware added

v0.2.9
- ActivityData model added
- ActivityFile model added
- CollectioinDetail model added
- SkpiCollection model added
- SkpiData model added
- SkpiFile model added
- Login with Google button changed 

v0.2.6
- socialite installed
- google login added

v0.2.5
- breeze installed

v0.2.2
- skpi_datas migration fixed 

v0.2.1
- readme updated

v0.2
- students migrations added
- lecturers migrations added
- skpi_collections migrations added
- collection_details migrations added
- skpi_datas migrations added
- skpi_files migrations added
- activity_datas migrations added
- activity_files migrations added
- lecturer controller added
- lecturer model added
- student controller added
- student model added

v0.1
- skpi template added


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
