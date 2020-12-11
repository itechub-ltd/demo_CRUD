import React, { useState } from 'react';
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

function Create(){

    const [name, setName] = useState(null);
    // const [status, setStatus] = useState(null);

    const saveCategory = async () => {

        const data ={name}
        const res = await CategoryService.save(data);
        console.log(res);

        if(res.success){
            alert(res.message)
        }
        else{
            alert(res.message)
        }
    }

    return(
        <div>
            <Container>
            <Row>
                <Col><h3>Create Category </h3></Col>
                
            </Row>
             <Form>
                <Form.Group controlId="formBasicEmail">
                    <Form.Label>Category Name</Form.Label>
                    <Form.Control type="name" placeholder="Enter name"
                      onChange={(event)=>setName(event.target.value)} />

                </Form.Group>


                <Button variant="primary" type="submit" onClick={()=>saveCategory()}>
                    Submit
                </Button>
                <Link to="/">
                    <Button variant="secondary" id="btnBack">
                    Back
                </Button>
                </Link>
             </Form>
            </Container>
        </div>

        )
    }

export default Create;