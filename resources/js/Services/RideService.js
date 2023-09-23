import axios from "axios";
import Swal from "sweetalert2";

class RideService {
    static getRides() {
        return axios
            .get("/api/v1/bookings")
            .then((response) => response.data)
            .catch((error) => {
                console.error("Error al obtener los viajes:", error);
                return [];
            });
    }

    static async updateRide(ride) {
        try {
            await axios.put(`/api/v1/bookings/${ride.id}`, ride);

            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Ride was successfully edited",
                showConfirmButton: false,
                timer: 1500,
            });
        } catch (e) {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Error while trying to update the ride",
                showConfirmButton: false,
                timer: 1500,
            });
        }
    }

    static async createRide(ride) {
        try {
            await axios.post(`/api/v1/bookings/`, ride);
            
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Ride was successfully created",
                showConfirmButton: false,
                timer: 1500,
            });
        } catch (e) {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Error while trying to create the ride",
                showConfirmButton: false,
                timer: 1500,
            });
        }
    }

    static async getRideByDate(date) {
        const urlDateFormat = `${date.getFullYear()}-${
            date.getMonth() + 1
        }-${date.getDate()}`;

        return axios
            .get(`/api/v1/filterByDate?date=${urlDateFormat}`)
            .then((response) => response.data)
            .catch((error) => {
                console.error("Error al obtener los rides por fecha:", error);
                return [];
            });

        return [];
    }

    static async filter(strContains) {
        return axios
            .get(`/api/v1/filterContains?contains=${strContains}`)
            .then((response) => response.data)
            .catch((error) => {
                console.error(
                    "Error al obtener el filter de los rides:",
                    error
                );
                return [];
            });

        return [];
    }

    static async deleteBooking(bookingId) {
        return await axios.delete(`/api/v1/bookings/${bookingId}`)
    }
}

export { RideService };
