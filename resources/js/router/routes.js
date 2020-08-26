/*Define Vue front-end routes here*/
import QuestionsPage from "../pages/QuestionsPage";
import QuestionPage from "../pages/QuestionPage";
import MyPostsPage from "../pages/MyPostsPage";
import NotFoundPage from "../pages/NotFoundPage";
import CreateQuestionPage from "../pages/CreateQuestionPage";

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
        name: 'questions',
    },
    {
        path: '/questions/create',
        component: CreateQuestionPage,
        name: 'questions.create',
    },
    {
        path: '/my-posts',
        component: MyPostsPage,
        name: 'my-posts',
        meta: {
            requiresAuth: true
        }
    },
    {
        //Dynamic route matching --> {slug}
        path: '/questions/:slug',
        component: QuestionPage,
        name: 'questions.show'
    },
    {
        //404 route
        path: '*',
        component: NotFoundPage,
    }
];

//To be used elsewhere
export default routes;
