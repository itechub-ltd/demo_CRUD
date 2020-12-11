import React, { useState, useEffect } from 'react';
import "../category.css";
import {
Link
  } from "react-router-dom";
import Table from "react-bootstrap/Table";
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Button from 'react-bootstrap/Button';

import CategoryService from "./../Services/CategoryService"

function List(){

    const [ listCategory, setListCategory ] = useState([]);

    useEffect(()=>{
            async function fetchCategory(){
                const res = await CategoryService.list();
                setListCategory(res.data)
            }
            fetchCategory();
    },[])

    const deleteCategory = async (i,id) => {
       var yes = window.confirm ("Are you sure to delete this category?");
       if(yes === true){
         const res = await CategoryService.delete(id);
         if(res.success){
           alert(res.message)
          const newList = listCategory
          newList.splice(i,1);
          setListCategory([...newList]);
         }
         else{
           alert(res.message)
         }

       }
    }


  return(
    <div>
     <Container>
        <Row>
            <Col><h3>Category list</h3></Col>
            <Col>
            <Link to="/add">
                <Button variant="secondary" size="sm" id="btnAdd">
                Add Category
            </Button>
            </Link>
            </Col>
        </Row>

       <Table striped bordered hover id="table">
        <thead>
            <tr>
            <th>#</th>
            <th> Name</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>

              {
                  listCategory.map((item,i)=>{
                      return(
                          <>
                             <tr>
                        <td> {i+1} </td>
                        <td>{item.name}</td>
                        <td>{item.status}</td>
                        <td>
                        <Link to={`/edit/${item.id}`} >
                         <Button variant="secondary">Edit</Button>
                        </Link>
                            ||
                            <Button variant="secondary"  onClick={()=>deleteCategory(i,item.id)}>Delete</Button>
                        </td>
                        </tr>
                        </>
                      )
                  })
                }

           </tbody>
         </Table>
    </Container>
</div>

  )
}

export default List;