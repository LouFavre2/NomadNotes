import http from "../http-common";

class MapDataService {

    getPlaces() {
        return http.get("/places");
      }
    getPlaceDetailed(id) {
      return http.get(`/places/${id}`) 
    } 
    addPlace(data: any) {
      return http.post("/places", data)
    }
    deletePlace(id) {
      return http.delete(`/places/${id}`)
    }
    getMemos() {
      return http.get("/memos");
    }
}
export default new MapDataService();