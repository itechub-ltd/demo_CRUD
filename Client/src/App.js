import React from "react";
import "./App.css";
import 'bootstrap/dist/css/bootstrap.min.css';
import {
  BrowserRouter as Router,
  Switch,
  Route,
} from "react-router-dom";
// import Navbar from "./Components/navbar";
import ListCategory from "./Components/Category/List";
import AddCategory from "./Components/Category/Create";
import EditCategory from "./Components/Category/Edit";


function App() {


  return (
    <div className="app">
    <Router>
   {/* <Navbar /> */}
      <Switch>
          <Route exact path="/" component={ListCategory} />
          <Route exact path="/add" component={AddCategory} />
          <Route exact path="/edit/:id" component={EditCategory} />
      </Switch>
     </Router>
    </div>
  );
}

export default App;