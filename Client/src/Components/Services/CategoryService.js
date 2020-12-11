import axios from "axios";
const baseUrl = "http://127.0.0.1:8000/api/categories";


const category ={};

category.list = async () => {
    const urlList = baseUrl
    const res = await axios.get(urlList)
    .then(response => { return response.data; })
    .catch(error =>{ return error; })
    return res;
}

category.save = async (data) => {
    const urlSave = baseUrl+"/create"
    const res = await axios.post(urlSave,data)
    console.log(res.data)
    .then(response=>{ return response.data })
    .catch(error=>{ return error; })
    return res;
}

category.get = async (id) => {

    const urlGet = baseUrl+"/"+id
    const res = await axios.get(urlGet)
    .then(response=>{ return response.data; })
    .catch(error=>{return error; })
    return res;
}

category.update = async (data) => {
    const urlUpdate = baseUrl+"/update/"+data.id
    const res = await axios.put(urlUpdate,data)
    .then(response=>{return response.data;})
    .catch(error=>{ return error; })
    return res;
}

category.delete = async (id) => {
    const urlDelete = baseUrl+"/delete/"+id
    const res = await axios.delete(urlDelete)
     .then(response=>{ return response.data })
     .catch(error=>{ return error; })
     return res;
}

export default category