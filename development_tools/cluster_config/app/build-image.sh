#!/usr/bin/env bash

cd development_tools/cluster_config/app/ && docker build --tag=k8s_php_dev . && cd ../../..