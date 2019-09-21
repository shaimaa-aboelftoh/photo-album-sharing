<?php

//------------------ All Logged Users ------------------

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('exploreAlbum', function ($trail, $album) {
    $trail->parent('home');
    $trail->push($album['name'], route('exploreAlbum'));
});

Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');
    $trail->push('Profile', route('profile.edit'));
});

Breadcrumbs::for('allAlbums', function ($trail) {
    $trail->parent('home');
    $trail->push('Albums', route('album.all'));
});

Breadcrumbs::for('createAlbum', function ($trail) {
    $trail->parent('home');
    $trail->push('Create Album', route('album.create'));
});

Breadcrumbs::for('showAlbum', function ($trail, $album) {
    $trail->parent('allAlbums');
    $trail->push(str_limit($album->name, 70), route('album.show', ['id' => $album->id]));
});

Breadcrumbs::for('updateAlbum', function ($trail, $album) {
    $trail->parent('allAlbums');
    $trail->push('Update Album', route('album.edit', ['id' => $album->id]));
});


// ------------------------- Dashboard Home  ---------------------------

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard.index'));
});

// ------------------------- Roles  ---------------------------

Breadcrumbs::for('allRoles', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('All Roles', route('dashboard.role.all'));
});

Breadcrumbs::for('createRole', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Create Role', route('dashboard.role.create'));
});

Breadcrumbs::for('showRole', function ($trail, $role) {
    $trail->parent('allRoles');
    $trail->push(str_limit($role->display_name, 70), route('dashboard.role.show', ['role' => $role]));
});

Breadcrumbs::for('updateRole', function ($trail, $role) {
    $trail->parent('allRoles');
    $trail->push('Update Role', route('dashboard.role.edit', ['role' => $role]));
});


// ------------------------- Users  --------------------------
Breadcrumbs::for('allAdmins', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Admins Management', route('dashboard.user.allAdmins'));
});

Breadcrumbs::for('allUsers', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Users Management', route('dashboard.user.allUsers'));
});

Breadcrumbs::for('createUser', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Create User', route('dashboard.user.create'));
});

Breadcrumbs::for('showUser', function ($trail, $prefix, $user) {
    $prefix == 'admins' ? $parent = 'allAdmins' : $parent = 'allUsers';
    $trail->parent($parent);
    $trail->push(str_limit($user->name, 70),
        route('dashboard.user.show', ['prefix' => $prefix, 'user' => $user]));
});

Breadcrumbs::for('updateUser', function ($trail, $prefix, $user) {
    $prefix == 'admins' ? $parent = 'allAdmins' : $parent = 'allUsers';
    $trail->parent($parent);
    $trail->push('Update User',
        route('dashboard.user.update', ['prefix' => $prefix, 'user' => $user]));
});

// ------------------------- Albums  ---------------------------

Breadcrumbs::for('userAlbums', function ($trail, $prefix, $user) {
    $trail->parent('showUser', $prefix, $user);
    $trail->push('Albums of ' . str_limit($user->name, 40),
        route('dashboard.album.all', ['prefix' => $prefix, 'user' => $user]));
});

Breadcrumbs::for('showUserAlbum', function ($trail, $prefix, $user, $album) {
    $trail->parent('userAlbums', $prefix, $user);
    $trail->push(str_limit($album->name, 40), route('album.show', ['prefix' => $prefix, 'user' => $user,'album' => $album]));
});

