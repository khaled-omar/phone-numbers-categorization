import http from "../src/http-common";

class PhoneNumberService {
    getAll(filters) {
        return http.get("/phone-numbers",{
            params: filters
        });
    }
}

export default new PhoneNumberService();
