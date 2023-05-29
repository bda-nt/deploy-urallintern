import axios from "axios";

const url = process.env.REACT_APP_API_URL;
export function onKanbanViewChange(taskId, isOnKanban) {
    const instance = axios.create({withCredentials: true});
    instance.post(`${url}/api/v1/gant/task/${taskId}/kanban_view`, { is_on_kanban: isOnKanban })
        .then(response => {
            console.log(response.data);
            window.location.reload()
        })
        .catch(error => {
            console.error(error);
        });
}