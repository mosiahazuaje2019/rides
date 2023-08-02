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
        const ride_id = 1;
        await axios.put(`/api/v1/bookings/${ride.id}`, ride);
    }
}

export { RideService };
