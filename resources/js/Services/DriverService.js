import axios from "axios";

class DriverService {
    static getDrivers() {
        return axios
            .get("http://localhost/api/v1/get_drivers")
            .then((response) => response.data)
            .catch((error) => {
                console.error("Error al obtener los drivers:", error);
                return [];
            });
    }
}

export { DriverService };
