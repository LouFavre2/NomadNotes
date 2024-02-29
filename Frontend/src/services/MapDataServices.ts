import http from "../http-common";

class MapDataService {

    getPlaces() {
        return http.get("/places");
      }
    addPlace(data: any) {
      return http.post("/places", data)
    }
}
export default new MapDataService();