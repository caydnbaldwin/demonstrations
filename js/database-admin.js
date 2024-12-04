document.addEventListener("DOMContentLoaded", () => {
    const userRows = document.querySelectorAll("#users-table tbody tr");
    const spiiRows = document.querySelectorAll("#spii-table tbody tr");

    userRows.forEach(userRow => {
        const userId = userRow.children[0].innerText; // id from users table
        spiiRows.forEach(spiiRow => {
            const spiiUserId = spiiRow.children[1].innerText; // user_id from user_SPII table
        });
    });
});
