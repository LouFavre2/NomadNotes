import http from "../http-common";

class MapDataService {

    getPlaces() {
        return http.get("/places");
      }
}
export default new MapDataService();