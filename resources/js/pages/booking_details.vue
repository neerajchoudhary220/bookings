<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        Booking Details
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="item-label">Name:</span> John Doe
                            </li>
                            <li class="list-group-item">
                                <span class="item-label">Email:</span> johndoe@example.com
                            </li>
                            <li class="list-group-item">
                                <span class="item-label">Booking Type:</span> Full Day
                            </li>
                            <li class="list-group-item">
                                <span class="item-label">Booking Date:</span> 2024-09-09
                            </li>
                            <li class="list-group-item">
                                <span class="item-label">Booking Slot:</span> Morning
                            </li>
                            <li class="list-group-item">
                                <span class="item-label">Booking Time:</span> 09:00 AM
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <router-link :to="{ name: 'booking_list'}">
                            <button class="btn btn-secondary">Back</button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Booking_details',

    setup() {


        return {}
    }
}
</script>

<style>
.card {
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: #007bff;
    color: #fff;
    font-size: 1.5rem;
    border-bottom: 0;
    border-radius: 15px 15px 0 0;
}

.card-body {
    font-size: 1.1rem;
}

.d-flex {
    justify-content: space-between;
}

.item-label {
    font-weight: bold;
}
</style>