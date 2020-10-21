function pageBack() {
    window.history.back();
}

function openEditProfile(link) {
    window.location.href = '../views/edit-profile.php?type='+link+'';
}