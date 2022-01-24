## SKPI
Website untuk pengumpulan data surat keterangan pendamping ijazah

## Install
composer install

npm install

npm run dev


## Changelog
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
