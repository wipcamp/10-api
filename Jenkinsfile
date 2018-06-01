pipeline {
  agent any
  environment {
    GIT_BRANCH = "${BRANCH_NAME}"
  }
  stages {
    stage('install-dependencies') {
      steps {
        sh 'sudo docker container run -v "$(pwd):/app" --rm composer:1.6.3 install'
        sh 'sudo docker container run -v "$(pwd):/app" --rm composer:1.6.3 dump-autoload'
      }
    }
    stage('build-image') {
      steps {
        sh 'sudo docker build . -t wip-api'
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api'
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api:$GIT_BRANCH'
      }
    }
    stage('push-image') {
      steps {
        sh 'sudo docker push registry.wip.camp/wip-api:$GIT_BRANCH'
        sh 'sudo docker push registry.wip.camp/wip-api'
      }
    }
    stage('versioning') {
      when {
        expression {
          return GIT_BRANCH == 'master'
        }
      }
      steps {
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api:$GIT_BRANCH-$BUILD_NUMBER'
        sh 'sudo docker push registry.wip.camp/wip-api:$GIT_BRANCH-$BUILD_NUMBER'
        sh 'sudo docker image rm registry.wip.camp/wip-api:$GIT_BRANCH-$BUILD_NUMBER'
      }
    }
    stage('clean') {
      steps {
        sh 'sudo docker image rm registry.wip.camp/wip-api:$GIT_BRANCH'
        sh 'sudo docker image rm registry.wip.camp/wip-api'
        sh 'sudo docker image rm wip-api'
      }
    }
    stage('deploy-development') {
      when {
        expression {
          branch = sh(returnStdout: true, script: 'echo $GIT_BRANCH').trim()
          return branch == 'develop'
        }
      }
      steps {
        script {
          if (GIT_BRANCH == 'master') {
            sh 'sudo kubectl rolling-update wip-api -n production --image registry.wip.camp/wip-api:master-$BUILD_NUMBER --image-pull-policy Always'
          } else {
            sh 'sudo kubectl rolling-update wip-api -n development --image registry.wip.camp/wip-api:$GIT_BRANCH --image-pull-policy=Always'
          }
        }
      }
    }
  }
  post {
    success {
      slackSend(color: "#228b22", message: "10-API on ${env.GIT_BRANCH} at build number ${env.BUILD_NUMBER} was built successfully & deploy. More infomation ${env.JENKINS_URL}")
    }
    failure {
      slackSend(color: "#ff0033", message: "10-API on ${env.GIT_BRANCH} was fail ${env.JENKINS_URL}")
    }
  }
}
