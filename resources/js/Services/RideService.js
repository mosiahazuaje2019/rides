import axios from "axios";

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
        await axios.put(`/api/v1/bookings/${ride.id}`, ride);
    }

    static async createRide(ride) {
        await axios.post(`/api/v1/bookings/`, ride);
    }

    static async getRideByDate(date) {
        const urlDateFormat = `${date.getDate()}-${
            date.getMonth() + 1
        }-${date.getFullYear()}`;

        // return axios
        //     .get(`/api/v1/bookings/${urlDateFormat}`)
        //     .then((response) => response.data)
        //     .catch((error) => {
        //         console.error("Error al obtener los rides por fecha:", error);
        //         return [];
        //     });

        return [];
    }
}

export { RideService };
