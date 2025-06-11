function updateTaskTime() {
    const now = new Date();
    document.querySelectorAll(".task-time").forEach((element) => {
        const dueDate = new Date(
            element.dataset.dueDate +
                " " +
                (element.dataset.dueTime || "23:59:59")
        );
        const timeDiff = dueDate - now;

        if (timeDiff < 0) {
            element.innerHTML = `<span class="text-danger">Overdue</span>`;
        } else {
            const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
            const hours = Math.floor(
                (timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            const minutes = Math.floor(
                (timeDiff % (1000 * 60 * 60)) / (1000 * 60)
            );

            let timeString = "";
            if (days > 0) timeString += `${days}d `;
            if (hours > 0) timeString += `${hours}h `;
            timeString += `${minutes}m remaining`;

            element.innerHTML = timeString;
        }
    });
}

// Update every minute
setInterval(updateTaskTime, 60000);
// Initial update
document.addEventListener("DOMContentLoaded", updateTaskTime);
