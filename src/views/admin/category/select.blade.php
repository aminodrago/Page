{{ Former::select('')
->options($categoryZones, $selected)
->name('category_zone_id')
->label(Lang::get('categories::module.category_zone')) }}<br/>
