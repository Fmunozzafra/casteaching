import axios from 'axios'
export default {
    videos: async function () {
        const response = await axios.get('http://casteaching.test/api/videos')
        return response.data
    }
}
