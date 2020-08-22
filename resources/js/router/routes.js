/*Define actual Vue routes here*/
import QuestionsPage from "../pages/QuestionsPage";
import QuestionPage from "../pages/QuestionPage";
import MyPostsPage from "../pages/MyPostsPage";

//Map components to respective routes, load paths
const routes = [
    {
        path: '/',
        component: QuestionsPage,
        name: 'home'
    },
    {
        path: '/questions',
        component: QuestionsPage,
        name: 'questions'
    },
    {
        path: '/my-posts',
        component: MyPostsPage,
        name: 'my-posts'
    },
    {
        //Dynamic route matching --> {slug}
        path: '/questions/:slug',
        component: QuestionPage,
        name: 'questions.show'
    }
];

//To be used elsewhere
export default routes;
