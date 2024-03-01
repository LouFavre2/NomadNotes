import http from "../http-common";

class MapDataService {

    getPlaces() {
        return http.get("/places");
      }
    addPlace(data: any) {
      return http.post("/places", data)
    }
    getMemos() {
      return http.get("/memos");
    }
}
export default new MapDataService();