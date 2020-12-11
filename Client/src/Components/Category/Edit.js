import React, { useState, useEffect } from 'react';
import "../category.css";
import {
     Link
  } from "react-router-dom";
import Form from "react-bootstrap/Form";
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Button from 'react-bootstrap/Button';


import CategoryService from "./../Services/CategoryService"

function Edit(props){

    const [id, setId] = useState(null);
    const [name, setName] = useState('');

    useEffect(()=>{
            async function fetchCategoryById(){
                let id = props.match.params.id;
                const res = await CategoryService.get(id);

                if(res.success){
                    console.log(res.data);
                    const data =res.data
                    setId(data.id)
                    setName(data.name)
                }else{
                    alert(res.message)
                }
            }
            fetchCategoryById();

    },[])

    const updateCategory = async () => {

        const data ={
            id, name
        }

        const res = await CategoryService.update(data);
        if(res.success){
            alert(res.message)
        }else{
            alert(res.message)
        }
    }



    return(
        <div>
            <Container>
            <Row>
                <Col><h3>Edit Category </h3></Col>
                
            </Row>
             <Form>
                <Form.Group controlId="formBasicEmail">
                    <Form.Label>Category Name</Form.Label>
                    <Form.Control type="text" placeholder="Enter name" value={name}
                    onChange={(event)=>setName(event.target.value)} />

                </Form.Group>


                <Button onClick={()=>updateCategory()} variant="primary" type="submit">
                    Submit
                </Button>
                <Link to="/">
                    <Button variant="secondary" size="sm" id="btnBack">
                    Back
                </Button>
                </Link>
             </Form>
            </Container>
        </div>

        )
    }

export default Edit;